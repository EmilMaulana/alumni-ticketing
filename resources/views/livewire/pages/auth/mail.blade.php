<?php

namespace App\Livewire\Auth;

use App\Mail\VerificationEmail;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        // Cek apakah pengguna sudah memverifikasi email
        if (Auth::user()->hasVerifiedEmail()) {
            // Jika sudah, arahkan ke halaman dashboard
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
            return;
        }

        // Dapatkan URL verifikasi
        $url = $this->verificationUrl(Auth::user());

        // Kirim notifikasi verifikasi email
        Mail::to(Auth::user()->email)->send(new VerificationEmail($url));

        // Tampilkan pesan bahwa tautan verifikasi telah dikirim
        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Dapatkan URL verifikasi
     */
    protected function verificationUrl($user)
    {
        return URL::temporarySignedRoute(
            'verification.verify', now()->addMinutes(60), ['id' => $user->id, 'hash' => sha1($user->email)]
        );
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }

    /**
     * Render the component.
     */
    public function render(): mixed
    {
        return view('livewire.auth.verify');
    }
};
