<?php

namespace App\Http\Controllers\Website;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use UniSharp\LaravelFilemanager\Controllers\UploadController;

class FileManagerUploadController extends UploadController
{
    public function upload()
    {
        $uploadedFiles = request()->file('upload');
        $errors = [];
        $newFilename = null;

        foreach (is_array($uploadedFiles) ? Arr::flatten($uploadedFiles) : [$uploadedFiles] as $file) {
            if (!$file) {
                continue;
            }

            try {
                $this->validateFile($file);
                $newFilename = $this->lfm->upload($file);
            } catch (\Exception $exception) {
                Log::error($exception->getMessage(), [
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                ]);
                $errors[] = $exception->getMessage();
            } catch (\Error $error) {
                Log::error($error->getMessage(), [
                    'file' => $error->getFile(),
                    'line' => $error->getLine(),
                ]);
                $errors[] = 'Some error occurred during upload.';
            }
        }

        if (is_array($uploadedFiles)) {
            return response()->json(count($errors) > 0 ? $errors : self::$success_response);
        }

        if (!$newFilename) {
            return response()->json([
                'error' => ['message' => $errors[0] ?? 'No file was uploaded.'],
            ]);
        }

        $url = $this->lfm->setName($newFilename)->url();

        return response()->json([
            'url' => $url,
            'uploaded' => $url,
        ]);
    }

    private function validateFile(UploadedFile $file): void
    {
        if (in_array(strtolower($file->getClientOriginalExtension()), ['html', 'htm'], true)) {
            throw new \RuntimeException('HTML uploads are not allowed.');
        }

        $this->lfm->validateUploadedFile($file);
    }
}