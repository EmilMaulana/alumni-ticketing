<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasProfilePhoto
{
    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? Storage::url($this->profile_photo_path)
            : $this->defaultProfilePhotoUrl();
    }

    /**
     * Delete the current profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        if (! is_null($this->profile_photo_path)) {
            Storage::delete($this->profile_photo_path);
            $this->forceFill(['profile_photo_path' => null])->save();
        }
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        return 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($this->email))).'?s=200&d=mm';
    }
}
