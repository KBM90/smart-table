<?php

/**
 * Image library backed by Unsplash.
 *
 * Each entry has:
 *   key   – a stable Unsplash photo ID (used as the value stored in the database)
 *   label – human-readable label shown in the product form picker
 *
 * URLs are resolved at render time via App\Support\LibraryImage::url($key).
 * No Unsplash API key is required for display-only usage; the CDN URL format
 * used is:  https://images.unsplash.com/photo-{id}?auto=format&fit=crop&w=400&q=80
 */

return [
    // ── Breakfast & Pastries ─────────────────────────────────────────────────
    ['key' => '1533089189872-0f8e2b990f42', 'label' => 'Breakfast Plate'],
    ['key' => '1555507036-ab1f4038808a', 'label' => 'Croissant'],

    // ── Mains ────────────────────────────────────────────────────────────────
    ['key' => '1568901346375-23c9450c58cd', 'label' => 'Burger'],
    ['key' => '1512621776951-a57141f2eefd', 'label' => 'Fresh Salad'],
    ['key' => '1565299624946-b28f40a0ae38', 'label' => 'Pizza'],
    ['key' => '1528137871618-79d2761e3fd5', 'label' => 'Sandwich'],

    // ── Desserts ─────────────────────────────────────────────────────────────
    ['key' => '1551024709-8f23befc3ead', 'label' => 'Dessert'],
    ['key' => '1563805042-7684c019e5b2', 'label' => 'Cake Slice'],

    // ── Hot Drinks ───────────────────────────────────────────────────────────
    ['key' => '1510707577719-ae7c14805e3a', 'label' => 'Espresso'],
    ['key' => '1572442388796-11668a67e10d', 'label' => 'Cappuccino'],
    ['key' => '1544787219-7f47ccb76574', 'label' => 'Tea'],

    // ── Cold Drinks ──────────────────────────────────────────────────────────
    ['key' => '1461023058943-07fcbe16d735', 'label' => 'Iced Coffee'],
    ['key' => '1437418747212-8d9709afab22', 'label' => 'Lemonade'],
    ['key' => '1553361371-9b22f78e8b1d', 'label' => 'Smoothie'],
    ['key' => '1556679908-b2e53e38cef7', 'label' => 'Ice Tea'],
];