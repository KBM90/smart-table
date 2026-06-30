<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\AccountVerificationCode;
use Illuminate\Support\Facades\Hash;

class AccountVerificationService
{
    public function __construct(
        protected WhatsAppVerificationSender $whatsAppSender,
    ) {}

    public function sendCode(User $user): void
    {
        $code = $this->generateCode();
        $expiresAt = now()->addMinutes(10);

        $user->forceFill([
            'verification_code_hash' => Hash::make($code),
            'verification_code_expires_at' => $expiresAt,
            'verification_code_sent_at' => now(),
        ])->save();

        if ($user->verification_method === 'whatsapp') {
            $this->whatsAppSender->send($user, $code);

            return;
        }

        $user->notify(new AccountVerificationCode($code, $expiresAt));
    }

    public function verify(User $user, string $code): bool
    {
        if (! $user->verification_code_hash || ! $user->verification_code_expires_at) {
            return false;
        }

        if ($user->verification_code_expires_at->isPast()) {
            return false;
        }

        if (! Hash::check($code, $user->verification_code_hash)) {
            return false;
        }

        $attributes = [
            'account_verified_at' => now(),
            'verification_code_hash' => null,
            'verification_code_expires_at' => null,
            'verification_code_sent_at' => null,
        ];

        if ($user->verification_method === 'email' && $user->email_verified_at === null) {
            $attributes['email_verified_at'] = now();
        }

        $user->forceFill($attributes)->save();

        return true;
    }

    protected function generateCode(): string
    {
        return str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }
}
