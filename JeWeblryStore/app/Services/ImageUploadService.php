<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    public function upload(UploadedFile $file, string $directory): string
    {
        return $file->store($directory, 'gcs');
    }

    public function delete(?string $path): void
    {
        if ($path && Storage::disk('gcs')->exists($path)) {
            Storage::disk('gcs')->delete($path);
        }
    }
}
