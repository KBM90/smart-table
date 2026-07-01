<?php

namespace App\Support;

class CustomerLocale
{
    public const COOKIE = 'st_customer_locale';

    public const DEFAULT = 'en';

    /**
     * Native display labels for the customer language switcher.
     */
    public static function options(): array
    {
        return [
            'en' => 'English',
            'fr' => 'Francais',
            'ar' => 'العربية',
            'es' => 'Espanol',
            'de' => 'Deutsch',
            'zh' => '中文',
            'ja' => '日本語',
        ];
    }

    public static function supported(): array
    {
        return array_keys(self::options());
    }

    public static function normalize(?string $locale): ?string
    {
        if (! is_string($locale) || $locale === '') {
            return null;
        }

        $locale = strtolower(str_replace('_', '-', trim($locale)));
        $locale = strtok($locale, '-') ?: $locale;

        return in_array($locale, self::supported(), true) ? $locale : null;
    }

    public static function direction(?string $locale): string
    {
        return self::normalize($locale) === 'ar' ? 'rtl' : 'ltr';
    }
}
