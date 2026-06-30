<?php

namespace Tests\Feature\Production;

use Tests\TestCase;

class ConfigSanityTest extends TestCase
{
    public function test_env_production_example_exists_and_disables_debug(): void
    {
        $contents = file_get_contents(base_path('.env.production.example'));

        $this->assertNotFalse($contents);
        $this->assertStringContainsString('APP_ENV=production', $contents);
        $this->assertStringContainsString('APP_DEBUG=false', $contents);
        $this->assertStringContainsString('SUPABASE_REALTIME_ANON_ENABLED=false', $contents);
        $this->assertStringContainsString('TRUSTED_PROXIES=*', $contents);
    }

    public function test_supabase_realtime_anon_is_disabled_by_default(): void
    {
        $this->assertFalse((bool) config('services.supabase.realtime_anon_enabled'));
    }

    public function test_env_production_example_does_not_contain_real_supabase_secrets(): void
    {
        $contents = file_get_contents(base_path('.env.production.example'));

        $this->assertNotFalse($contents);
        $this->assertStringContainsString('DB_PASSWORD=your-supabase-db-password', $contents);
        $this->assertStringContainsString('SUPABASE_SERVICE_ROLE_KEY=your-supabase-service-role-key', $contents);
        $this->assertDoesNotMatchRegularExpression('/^SUPABASE_(ANON_KEY|SERVICE_ROLE_KEY)=eyJ/m', $contents);
    }

    public function test_app_debug_resolves_false_for_production_even_if_env_requests_true(): void
    {
        $appConfig = $this->evaluateAppConfig([
            'APP_ENV' => 'production',
            'APP_DEBUG' => 'true',
        ]);

        $this->assertFalse($appConfig['debug']);
    }

    /**
     * @param  array<string, string>  $environment
     * @return array<string, mixed>
     */
    private function evaluateAppConfig(array $environment): array
    {
        $original = [];

        foreach ($environment as $key => $value) {
            $original[$key] = getenv($key);
            putenv($key.'='.$value);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }

        try {
            return require base_path('config/app.php');
        } finally {
            foreach ($environment as $key => $value) {
                if ($original[$key] === false) {
                    putenv($key);
                    unset($_ENV[$key], $_SERVER[$key]);

                    continue;
                }

                putenv($key.'='.$original[$key]);
                $_ENV[$key] = $original[$key];
                $_SERVER[$key] = $original[$key];
            }
        }
    }
}
