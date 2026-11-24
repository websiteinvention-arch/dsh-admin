<?php

namespace App\Services;

use App\Models\Page;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use RuntimeException;

class WebsiteSeoFiles
{
    public function regenerate(int $websiteId): void
    {
        $domain = $this->getDomain($websiteId);
        $pages = Page::where('website_id', $websiteId)
            ->where('status', 1)
            ->orderBy('slug')
            ->get(['slug', 'updated_at']);

        $sitemap = $this->buildSitemap($pages, $domain);
        $robots = "User-agent: *\nAllow: /\n";

        if ($domain !== null) {
            $robots .= "Sitemap: {$domain}/sitemap.xml\n";
        }

        $disk = Storage::disk('public');
        $directory = "files/{$websiteId}";

        foreach ([
            "{$directory}/sitemap.xml" => $sitemap,
            "{$directory}/robots.txt" => $robots,
        ] as $path => $contents) {
            if (!$disk->put($path, $contents)) {
                throw new RuntimeException("Unable to write website SEO file: {$path}");
            }
        }
    }

    private function getDomain(int $websiteId): ?string
    {
        $domain = trim((string) WebsiteSetting::where('website_id', $websiteId)->value('domain'));

        if ($domain === '') {
            return null;
        }

        if (!preg_match('~^https?://~i', $domain)) {
            $domain = 'https://' . $domain;
        }

        $parts = parse_url($domain);

        if (
            $parts === false ||
            empty($parts['host']) ||
            !in_array(strtolower($parts['scheme'] ?? ''), ['http', 'https'], true)
        ) {
            throw new InvalidArgumentException('The website domain must be a valid HTTP or HTTPS domain.');
        }

        return strtolower($parts['scheme']) . '://' . $parts['host'] .
            (isset($parts['port']) ? ':' . $parts['port'] : '');
    }

    private function buildSitemap(iterable $pages, ?string $domain): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $seenUrls = [];

        if ($domain !== null) {
            foreach ($pages as $page) {
                $slug = trim((string) $page->slug, '/');
                $path = $slug === '' || $slug === 'home'
                    ? ''
                    : '/' . implode('/', array_map('rawurlencode', explode('/', $slug)));
                $url = $domain . $path;

                if (isset($seenUrls[$url])) {
                    continue;
                }

                $seenUrls[$url] = true;
                $xml .= '<url><loc>' . htmlspecialchars($url, ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc>';

                if ($page->updated_at !== null) {
                    $xml .= '<lastmod>' . $page->updated_at->toAtomString() . '</lastmod>';
                }

                $xml .= '</url>';
            }
        }

        return $xml . '</urlset>' . "\n";
    }
}
