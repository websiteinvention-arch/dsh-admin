<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TemplateFileController extends Controller
{
    public function index(Request $request)
    {
        $websiteId = session('website_id');

        $file = $request->query('file');

        $content = '';

        if ($file) {

            $basePath = storage_path('app/public/files/' . $websiteId);

            $filePath = realpath($basePath . '/' . $file);

            if (
                $filePath &&
                str_starts_with($filePath, realpath($basePath)) &&
                File::exists($filePath)
            ) {
                $content = File::get($filePath);
            }
        }

        return view('website.template-editor.index', [
            'content' => $content,
            'file' => $file,
        ]);
    }

    public function edit(Request $request)
{
    $websiteId = session('website_id');

    $file = $request->query('file');

    if (!$file) {
        abort(404);
    }

    $basePath = storage_path('app/public/files/' . $websiteId);

    $filePath = realpath($basePath . '/' . $file);

    if (
        !$filePath ||
        !str_starts_with($filePath, realpath($basePath)) ||
        !File::exists($filePath)
    ) {
        abort(404);
    }

    $content = File::get($filePath);

    return view('website.template-editor.index', compact(
        'content',
        'file'
    ));
}


public function save(Request $request)
{
    $websiteId = session('website_id');

    $file = $request->input('file');
    $content = $request->input('content');

    if (!$file || $content === null) {
        return response()->json([
            'success' => false,
            'message' => 'File and content are required.'
        ], 422);
    }

    $basePath = storage_path('app/public/files/' . $websiteId);

    $realBasePath = realpath($basePath);

    if (!$realBasePath) {
        return response()->json([
            'success' => false,
            'message' => 'Website directory not found.'
        ], 404);
    }

    $filePath = realpath($basePath . '/' . $file);

    // Security check: make sure the file belongs to this website
    if (
        !$filePath ||
        !str_starts_with($filePath, $realBasePath . DIRECTORY_SEPARATOR) ||
        !File::exists($filePath)
    ) {
        return response()->json([
            'success' => false,
            'message' => 'File not found.'
        ], 404);
    }

    File::put($filePath, $content);

    return response()->json([
        'success' => true,
        'message' => 'File saved successfully.'
    ]);
}


}