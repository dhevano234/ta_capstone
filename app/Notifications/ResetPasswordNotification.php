<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Password Pasien')
            ->greeting('Halo!')
            ->line('Anda menerima email ini karena ada permintaan untuk mereset password akun Anda.')
            ->line('Silakan klik tombol di bawah untuk membuat password baru.')
            ->action('Reset Password', $url)
            ->line('Link reset password ini akan kedaluwarsa dalam :count menit.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')])
            ->line('Jika Anda tidak meminta reset password, abaikan email ini dan tidak ada perubahan yang akan terjadi pada akun Anda.')
            ->salutation('Terima kasih,')
            ->salutation('Tim Klinik Pratama Hadiana Sehat');
    }
}