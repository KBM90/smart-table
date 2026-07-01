<?php

namespace App\Support;

class AppLocale
{
    public const COOKIE = 'st_app_locale';

    public const DEFAULT = 'en';

    public static function options(): array
    {
        return [
            'en' => 'English',
            'fr' => 'Francais',
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
}
