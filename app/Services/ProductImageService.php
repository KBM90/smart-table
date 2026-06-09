<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Tenant;
use App\Support\LibraryImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductImageService
{
    public function validateUpload(UploadedFile $file): void
    {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($file->getMimeType(), $allowedMimeTypes, true)) {
            throw ValidationException::withMessages([
                'upload' => 'The upload must be a JPG, PNG, or WEBP image.',
            ]);
        }

        if ($file->getSize() > 4 * 1024 * 1024) {
            throw ValidationException::withMessages([
                'upload' => 'The upload must not be larger than 4 MB.',
            ]);
        }

        $dimensions = @getimagesize($file->getRealPath());

        if ($dimensions === false || $dimensions[0] < 256 || $dimensions[1] < 256) {
            throw ValidationException::withMessages([
                'upload' => 'The upload must be at least 256x256 pixels.',
            ]);
        }
    }

    public function storeUpload(Tenant $tenant, UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'jpg');

        return $file->storeAs(
            'products/' . $tenant->getKey(),
            Str::uuid()->toString() . '.' . $extension,
            config('filesystems.product_disk')
        );
    }

    public function deleteUpload(string $path): void
    {
        Storage::disk(config('filesystems.product_disk'))->delete($path);
    }

    public function applyToProduct(Product $product, string $source, ?string $key, ?UploadedFile $upload): void
    {
        $previousUploadPath = $product->image_source === Product::IMAGE_SOURCE_UPLOAD
            ? $product->image_path
            : null;

        if ($source === Product::IMAGE_SOURCE_UPLOAD) {
            if (!$upload instanceof UploadedFile) {
                throw ValidationException::withMessages([
                    'upload' => 'Please choose an image to upload.',
                ]);
            }

            $this->validateUpload($upload);

            $path = $this->storeUpload($product->tenant, $upload);

            $product->forceFill([
                'image_source' => Product::IMAGE_SOURCE_UPLOAD,
                'image_path' => $path,
            ]);

            if ($previousUploadPath !== null && $previousUploadPath !== $path) {
                $this->deleteUpload($previousUploadPath);
            }

            return;
        }

        if ($previousUploadPath !== null) {
            $this->deleteUpload($previousUploadPath);
        }

        if ($source === Product::IMAGE_SOURCE_LIBRARY) {
            // Validate that the submitted key exists in the configured library.
            // LibraryImage::exists() checks config('image_library') so it
            // automatically works with any key format (local paths, photo IDs…).
            if (!$key || !LibraryImage::exists($key)) {
                throw ValidationException::withMessages([
                    'selectedLibraryImage' => 'Please choose a valid library image.',
                ]);
            }

            $product->forceFill([
                'image_source' => Product::IMAGE_SOURCE_LIBRARY,
                'image_path' => $key,
            ]);

            return;
        }

        $product->forceFill([
            'image_source' => Product::IMAGE_SOURCE_NONE,
            'image_path' => null,
        ]);
    }
}