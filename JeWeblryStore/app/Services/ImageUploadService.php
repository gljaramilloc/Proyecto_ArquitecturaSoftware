<?php

namespace App\Services;

use Google\Cloud\Storage\Bucket;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\UploadedFile;

class ImageUploadService
{
    /**
     * Upload a file to the GCS bucket and return its stored path.
     */
    public function upload(UploadedFile $file, string $directory): string
    {
        $path = $directory.'/'.uniqid().'.'.$file->getClientOriginalExtension();

        $this->bucket()->upload(
            fopen($file->getRealPath(), 'r'),
            ['name' => $path]
        );

        return $path;
    }

    /**
     * Delete a file from the GCS bucket.
     */
    public function delete(?string $path): void
    {
        if (! $path) {
            return;
        }

        $object = $this->bucket()->object($path);

        if ($object->exists()) {
            $object->delete();
        }
    }

    /**
     * Resolve the configured GCS bucket.
     */
    private function bucket(): Bucket
    {
        $client = new StorageClient([
            'projectId' => config('filesystems.disks.gcs.project_id'),
        ]);

        return $client->bucket(config('filesystems.disks.gcs.bucket'));
    }
}
