<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppVerificationSender
{
    public function send(User $user, string $code): void
    {
        $webhookUrl = config('services.whatsapp.verification_webhook_url');

        if ($webhookUrl) {
            Http::post($webhookUrl, [
                'to' => $user->phone,
                'message' => "Your Smart Table verification code is {$code}.",
                'code' => $code,
                'user_id' => $user->id,
            ])->throw();

            return;
        }

        Log::info('WhatsApp verification code generated.', [
            'user_id' => $user->id,
            'phone' => $user->phone,
            'code' => $code,
        ]);
    }
}
