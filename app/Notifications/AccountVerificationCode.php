<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;

class AccountVerificationCode extends Notification
{
    use Queueable;

    public function __construct(
        public readonly string $code,
        public readonly Carbon $expiresAt,
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Verify your Smart Table account')
            ->greeting('Verify your account')
            ->line('Use this verification code to secure your Smart Table workspace:')
            ->line($this->code)
            ->line('This code expires at '.$this->expiresAt->format('H:i').'.');
    }
}
