<?php

namespace App\Services\Template;

use App\Models\Page;
use App\Models\CodeSnippet;
use App\Models\Entity;
use App\Models\EntityRecord;
use App\Models\EntityRecordValue;

class TemplateRenderer
{
    public function renderForWebsite(
        int $websiteId,
        string $templateFile,
        Page $page
    ): string {
        $websiteFilesPath = realpath(
            storage_path('app/public/files/' . $websiteId)
        );

        if ($websiteFilesPath === false) {
            abort(404);
        }

        $templatePath = realpath(
            $websiteFilesPath . DIRECTORY_SEPARATOR . $templateFile
        );

        if (
            $templatePath === false ||
            !str_starts_with($templatePath, $websiteFilesPath . DIRECTORY_SEPARATOR) ||
            !is_file($templatePath)
        ) {
            abort(404);
        }

        $html = file_get_contents($templatePath);

        /*
        |--------------------------------------------------------------------------
        | Page Shortcodes
        |--------------------------------------------------------------------------
        */

        $html = preg_replace_callback(
            '/\[page\s+field=([a-zA-Z0-9_]+)\]/',
            function ($matches) use ($page) {

                $field = $matches[1];

                if (!array_key_exists($field, $page->getAttributes())) {
                    return '';
                }

                return $page->{$field} ?? '';
            },
            $html
        );

        /*
        |--------------------------------------------------------------------------
        | Code Snippet Shortcodes
        |--------------------------------------------------------------------------
        */

        $html = preg_replace_callback(
            '/\[code_snippet\s+slug=([a-zA-Z0-9_-]+)\]/',
            function ($matches) use ($websiteId) {

                $slug = $matches[1];

                $snippet = CodeSnippet::where('website_id', $websiteId)
                    ->where('slug', $slug)
                    ->first();

                if (!$snippet) {
                    return '';
                }

                return $snippet->code ?? '';
            },
            $html
        );

        /*
        |--------------------------------------------------------------------------
        | Entity Single Field Shortcode
        |--------------------------------------------------------------------------
        |
        | Examples:
        |
        | [entity slug=services field=Title]
        | [entity slug=services field=title]
        | [entity slug=services field="short description"]
        |
        */

        /*
|--------------------------------------------------------------------------
| Entity Block Shortcode
|--------------------------------------------------------------------------
*/

$html = preg_replace_callback(
    '/\[entity\s+slug\s*=\s*([a-zA-Z0-9_-]+)\s*\](.*?)\[\/entity\]/is',
    function ($matches) use ($websiteId) {

        $entitySlug = trim($matches[1]);
        $blockTemplate = $matches[2];

        $entity = Entity::where('website_id', $websiteId)
            ->where('slug', $entitySlug)
            ->where('status', 1)
            ->first();

        if (!$entity) {
            return '';
        }

        $records = EntityRecord::where(
            'entity_id',
            $entity->id
        )->get();

        $output = '';

        foreach ($records as $record) {

            $recordHtml = $blockTemplate;

            $recordHtml = preg_replace_callback(
                '/\[field\s*=\s*(?:"([^"]+)"|([^\]]+))\]/i',
                function ($fieldMatches) use ($entity, $record) {

                    $fieldName = trim(
                        $fieldMatches[1] ?? $fieldMatches[2]
                    );

                    $field = $entity->fields()
                        ->where('status', 1)
                        ->whereRaw(
                            'LOWER(field_name) = ?',
                            [strtolower($fieldName)]
                        )
                        ->first();

                    if (!$field) {
                        return '';
                    }

                    $recordValue = EntityRecordValue::where(
                        'entity_record_id',
                        $record->id
                    )
                    ->where(
                        'entity_field_id',
                        $field->id
                    )
                    ->first();

                    return $recordValue?->value ?? '';
                },
                $recordHtml
            );

            $output .= $recordHtml;
        }

        return $output;
    },
    $html
);


/*
|--------------------------------------------------------------------------
| Entity Single Field Shortcode
|--------------------------------------------------------------------------
|
| Examples:
|
| [entity slug=services field="Title"]
| [entity slug=services field="title"]
| [entity slug=services field="short description"]
|
*/

$html = preg_replace_callback(
    '/\[entity\s+slug\s*=\s*([a-zA-Z0-9_-]+)\s+field\s*=\s*(?:"([^"]+)"|([^\]]+))\]/i',
    function ($matches) use ($websiteId) {

        $entitySlug = trim($matches[1]);

        $fieldName = trim(
            $matches[2] ?? $matches[3]
        );

        $entity = Entity::where('website_id', $websiteId)
            ->where('slug', $entitySlug)
            ->where('status', 1)
            ->first();

        if (!$entity) {
            return '';
        }

        $field = $entity->fields()
            ->where('status', 1)
            ->whereRaw(
                'LOWER(field_name) = ?',
                [strtolower($fieldName)]
            )
            ->first();

        if (!$field) {
            return '';
        }

        $records = EntityRecord::where(
            'entity_id',
            $entity->id
        )->get();

        $output = '';

        foreach ($records as $record) {

            $recordValue = EntityRecordValue::where(
                'entity_record_id',
                $record->id
            )
            ->where(
                'entity_field_id',
                $field->id
            )
            ->first();

            if ($recordValue) {
                $output .= $recordValue->value ?? '';
            }
        }

        return $output;
    },
    $html
);

        return $html;
    }

}