<?php

namespace Tests\Feature\Owner;

use App\Livewire\Owner\Products\Form;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ProductImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_upload_image_is_stored_and_product_uses_upload_source(): void
    {
        Storage::fake('public');
        Config::set('filesystems.product_disk', 'public');

        $owner = User::factory()->owner()->create();

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Croissant')
            ->set('price', '2.00')
            ->set('imageSource', Product::IMAGE_SOURCE_UPLOAD)
            ->set('upload', UploadedFile::fake()->image('croissant.png', 512, 512))
            ->call('save')
            ->assertHasNoErrors();

        $product = Product::firstOrFail();

        $this->assertSame(Product::IMAGE_SOURCE_UPLOAD, $product->image_source);
        $this->assertStringStartsWith('products/'.$owner->tenant_id.'/', $product->image_path);
        Storage::disk('public')->assertExists($product->image_path);
    }

    public function test_replacing_upload_with_library_deletes_previous_upload(): void
    {
        Storage::fake('public');
        Config::set('filesystems.product_disk', 'public');

        $owner = User::factory()->owner()->create();
        $product = Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'image_source' => Product::IMAGE_SOURCE_UPLOAD,
            'image_path' => 'products/'.$owner->tenant_id.'/old.png',
        ]);
        Storage::disk('public')->put($product->image_path, 'old-image');

        Livewire::actingAs($owner)
            ->test(Form::class, ['productId' => $product->id])
            ->set('imageSource', Product::IMAGE_SOURCE_LIBRARY)
            ->set('selectedLibraryImage', 'library/drink-2.jpg')
            ->call('save')
            ->assertHasNoErrors();

        $product->refresh();

        $this->assertSame(Product::IMAGE_SOURCE_LIBRARY, $product->image_source);
        $this->assertSame('library/drink-2.jpg', $product->image_path);
        Storage::disk('public')->assertMissing('products/'.$owner->tenant_id.'/old.png');
    }

    public function test_replacing_upload_with_none_deletes_previous_upload(): void
    {
        Storage::fake('public');
        Config::set('filesystems.product_disk', 'public');

        $owner = User::factory()->owner()->create();
        $product = Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'image_source' => Product::IMAGE_SOURCE_UPLOAD,
            'image_path' => 'products/'.$owner->tenant_id.'/old.png',
        ]);
        Storage::disk('public')->put($product->image_path, 'old-image');

        Livewire::actingAs($owner)
            ->test(Form::class, ['productId' => $product->id])
            ->set('imageSource', Product::IMAGE_SOURCE_NONE)
            ->call('save')
            ->assertHasNoErrors();

        $product->refresh();

        $this->assertSame(Product::IMAGE_SOURCE_NONE, $product->image_source);
        $this->assertNull($product->image_path);
        Storage::disk('public')->assertMissing('products/'.$owner->tenant_id.'/old.png');
    }

    public function test_upload_larger_than_four_mb_or_unsupported_mime_is_rejected(): void
    {
        Storage::fake('public');
        Config::set('filesystems.product_disk', 'public');

        $owner = User::factory()->owner()->create();
        $largeFile = UploadedFile::fake()->create('large.png', 5001, 'image/png');

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Big File')
            ->set('price', '5.00')
            ->set('imageSource', Product::IMAGE_SOURCE_UPLOAD)
            ->set('upload', $largeFile)
            ->call('save')
            ->assertHasErrors(['upload']);

        $badMime = UploadedFile::fake()->create('menu.pdf', 100, 'application/pdf');

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Wrong Type')
            ->set('price', '5.00')
            ->set('imageSource', Product::IMAGE_SOURCE_UPLOAD)
            ->set('upload', $badMime)
            ->call('save')
            ->assertHasErrors(['upload']);
    }

    public function test_library_key_must_exist(): void
    {
        $owner = User::factory()->owner()->create();

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Invalid Library')
            ->set('price', '4.00')
            ->set('imageSource', Product::IMAGE_SOURCE_LIBRARY)
            ->set('selectedLibraryImage', 'library/not-real.jpg')
            ->call('save')
            ->assertHasErrors(['selectedLibraryImage']);
    }
}