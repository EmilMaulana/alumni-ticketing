<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Verify extends Component
{
    public function sendVerification()
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        // Kirim email verifikasi
        Auth::user()->sendEmailVerificationNotification();

        // Simpan status ke flash session
        session()->flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/');
    }

    public function render()
    {
        return view('livewire.auth.verify');
    }
}
