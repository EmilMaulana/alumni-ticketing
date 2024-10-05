<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    use WithFileUploads;

    public $profile_photo;

    public function mount()
    {
        $this->profile_photo = Auth::user()->profile_photo_path;
    }

    public function updateProfile()
    {
        $this->validate([
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        if ($this->profile_photo) {
            // Hapus foto profil lama jika ada
            if ($user->profile_photo_path) {
                Storage::delete('public/' . $user->profile_photo_path);
            }

            // Upload dan simpan foto profil baru
            $path = $this->profile_photo->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->save();
        session()->flash('message', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
