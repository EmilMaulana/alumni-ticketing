<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomEmailVerificationNotification extends BaseVerifyEmail
{
    /**
     * Menentukan saluran pengiriman notifikasi.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; // Mengirim notifikasi melalui email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Verifikasi Email')
            ->view('emails.verification', [
                'url' => $this->verificationUrl($notifiable),
            ]);
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', 
            now()->addMinutes(60), 
            [
                'id' => $notifiable->getKey(), 
                'hash' => sha1($notifiable->getEmailForVerification()) // Menghitung hash
            ]
        );
    }
}
