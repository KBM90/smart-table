<?php

namespace Tests\Feature;

use Tests\TestCase;

class LegalPagesTest extends TestCase
{
    public function test_terms_of_service_page_is_public(): void
    {
        $this->get('/terms-of-service')
            ->assertOk()
            ->assertSeeText('Terms of Service')
            ->assertSeeText('support@smartable.space');
    }

    public function test_privacy_policy_page_is_public(): void
    {
        $this->get('/privacy-policy')
            ->assertOk()
            ->assertSeeText('Privacy Policy')
            ->assertSeeText('support@smartable.space');
    }

    public function test_refund_policy_page_is_public(): void
    {
        $this->get('/refund-policy')
            ->assertOk()
            ->assertSeeText('Refund Policy')
            ->assertSeeText('support@smartable.space');
    }
}
