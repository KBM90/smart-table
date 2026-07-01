<?php

namespace Tests\Feature\Customer;

use App\Models\Product;
use App\Models\Table;
use App\Support\CustomerLocale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocalizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_language_query_translates_table_page_and_sets_cookie(): void
    {
        $table = Table::factory()->create();

        $this->get('/t/'.$table->qr_token.'?lang=fr')
            ->assertOk()
            ->assertCookie(CustomerLocale::COOKIE, 'fr')
            ->assertSeeText('Appeler un serveur')
            ->assertSee('lang="fr"', false)
            ->assertSee('dir="ltr"', false);
    }

    public function test_customer_language_cookie_is_used_for_catalog(): void
    {
        $table = Table::factory()->create();

        Product::factory()->create([
            'tenant_id' => $table->tenant_id,
            'name' => 'Espresso',
            'is_active' => true,
        ]);

        $this->withCookie(CustomerLocale::COOKIE, 'de')
            ->get('/t/'.$table->qr_token.'/catalog')
            ->assertOk()
            ->assertSeeText('Katalog')
            ->assertSeeText('Zuruck zum Tisch')
            ->assertSeeText('Espresso');
    }

    public function test_arabic_customer_locale_sets_rtl_direction(): void
    {
        $table = Table::factory()->create();

        $this->get('/t/'.$table->qr_token.'?lang=ar')
            ->assertOk()
            ->assertSee('lang="ar"', false)
            ->assertSee('dir="rtl"', false)
            ->assertSeeText('استدعاء النادل');
    }
}
