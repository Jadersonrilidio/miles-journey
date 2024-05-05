<?php

namespace App\Helpers\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait StorageHelper
{
    /**
     * Store the file with the profile picture config.
     *
     * @param UploadedFile $file
     *
     * @return string Filename and URI link to image.
     */
    public function storeProfilePicture(UploadedFile $file): string
    {
        return $file->store('profile-pictures', 'public');
    }

    /**
     * Delete a file within the public profile-picture folder.
     *
     * @param string $filename
     *
     * @return bool TRUE if the file is deleted with success, FALSE otherwise.
     */
    public function deleteProfilePicture(string $filename): bool
    {
        return Storage::disk('public')->delete($filename);
    }

    /**
     * Store the file.
     *
     * @param UploadedFile $file
     *
     * @return string Filename and URI link to image.
     */
    public function storeDestinationPhoto(UploadedFile $file): string
    {
        return $file->store('destinations', 'public');
    }

    /**
     * Delete a file.
     *
     * @param string $filename
     *
     * @return bool TRUE if the file is deleted with success, FALSE otherwise.
     */
    public function deleteDestinationPhoto(string $filename): bool
    {
        return Storage::disk('public')->delete($filename);
    }
}
