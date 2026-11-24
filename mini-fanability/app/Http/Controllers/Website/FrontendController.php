<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\Template\TemplateRenderer;
use Symfony\Component\Mime\MimeTypes;

class FrontendController extends Controller
{
    public function preview(int $websiteId, string $slug, TemplateRenderer $renderer)
    {
        abort_unless((int) session('website_id') === $websiteId, 404);

        $slug = trim($slug, '/');

        if ($slug === '') {
            $slug = 'home';
        }

        $websiteFilesPath = realpath(storage_path('app/public/files/' . $websiteId));
        $assetPath = $websiteFilesPath
            ? realpath($websiteFilesPath . DIRECTORY_SEPARATOR . $slug)
            : false;

        if (
            $assetPath &&
            str_starts_with($assetPath, $websiteFilesPath . DIRECTORY_SEPARATOR) &&
            is_file($assetPath)
        ) {
            $extension = pathinfo($assetPath, PATHINFO_EXTENSION);
            $mimeType = MimeTypes::getDefault()->getMimeTypes($extension)[0]
                ?? 'application/octet-stream';

            return response()->file($assetPath, ['Content-Type' => $mimeType]);
        }

        // Find the page for this website
        $page = Page::where('website_id', $websiteId)
            ->where('status', 1)
            ->whereIn('slug', array_unique([$slug, $slug . '/']))
            ->first();

        if (!$page) {
            abort(404, 'Page not found.');
        }

        // Get template filename
        $templateFile = $page->template_file;

        if (!$templateFile) {
            abort(404, 'No template assigned to this page.');
        }

        // Load the physical HTML template
       $html = $renderer->renderForWebsite(
    $websiteId,
    $templateFile,
    $page
);

        $previewBase = rtrim(url('/website/preview/' . $websiteId), '/') . '/';
        $html = preg_replace_callback(
            '~(<a\b[^>]*?\bhref\s*=\s*)(["\x27])(/(?!/)[^"\x27]*)\2~i',
            function ($matches) use ($previewBase) {
                return $matches[1] . $matches[2] . $previewBase .
                    ltrim($matches[3], '/') . $matches[2];
            },
            $html
        );

        return response($html);
    }
}