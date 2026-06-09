<?php

namespace App\Support;

/**
 * Resolves image-library config keys to display URLs.
 *
 * Keys are Unsplash photo IDs stored in config/image_library.php.
 * The helper builds a CDN URL that works without any API key for
 * display/thumbnail purposes.
 */
class LibraryImage
{
    /**
     * Default thumbnail dimensions used across the application.
     */
    public const DEFAULT_WIDTH = 400;
    public const DEFAULT_HEIGHT = 400;

    /**
     * Resolve a library key (Unsplash photo ID) to a fully qualified URL.
     *
     * Falls back to the local placeholder when the key is empty/null so
     * callers never receive a broken image source.
     */
    public static function url(?string $key, int $width = self::DEFAULT_WIDTH, int $height = self::DEFAULT_HEIGHT): string
    {
        if (empty($key)) {
            return asset('img/library/_placeholder.png');
        }

        // Already a full URL (e.g. legacy entries or future-proof external URLs)
        if (str_starts_with($key, 'http://') || str_starts_with($key, 'https://')) {
            return $key;
        }

        // Legacy local path support (library/food-1.jpg) kept for any rows
        // that were stored before the Unsplash migration.
        if (str_contains($key, '/') || str_ends_with($key, '.jpg') || str_ends_with($key, '.png')) {
            return asset('img/' . ltrim($key, '/'));
        }

        // Unsplash photo ID — build the CDN URL directly (no API key needed).
        return sprintf(
            'https://images.unsplash.com/photo-%s?auto=format&fit=crop&w=%d&h=%d&q=80',
            $key,
            $width,
            $height,
        );
    }

    /**
     * Return a larger version of the same photo for full-size display.
     */
    public static function fullUrl(?string $key, int $width = 800, int $height = 600): string
    {
        return static::url($key, $width, $height);
    }

    /**
     * Retrieve the full library config array.
     *
     * @return array<int, array{key: string, label: string}>
     */
    public static function all(): array
    {
        return config('image_library', []);
    }

    /**
     * Check whether a key exists in the configured library.
     */
    public static function exists(string $key): bool
    {
        return collect(static::all())->pluck('key')->contains($key);
    }
}