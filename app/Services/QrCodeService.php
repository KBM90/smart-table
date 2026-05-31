<?php

namespace App\Services;

use App\Models\Table;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;

class QrCodeService
{
    public function pngFor(Table $table, int $size = 512, int $margin = 2): string
    {
        $writer = new Writer(new GDLibRenderer($size, $margin, 'png'));

        return $writer->writeString($table->getPublicUrl());
    }

    public function dataUrlFor(Table $table, int $size = 512, int $margin = 2): string
    {
        return 'data:image/png;base64,'.base64_encode($this->pngFor($table, $size, $margin));
    }
}
