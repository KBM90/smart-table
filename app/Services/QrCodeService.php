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
        $qrPng = $writer->writeString($table->getPublicUrl());

        return $this->appendLabel($qrPng, 'Table N° : ' . $table->name);
    }

    public function dataUrlFor(Table $table, int $size = 512, int $margin = 2): string
    {
        return 'data:image/png;base64,' . base64_encode($this->pngFor($table, $size, $margin));
    }

    /**
     * Stamp a centred label strip beneath the QR code image.
     *
     * GD's imagestring() uses ISO-8859-1, so we transcode the UTF-8 label
     * (the degree sign ° is 0xB0 in Latin-1) before drawing.
     */
    private function appendLabel(string $pngData, string $label): string
    {
        $qr = imagecreatefromstring($pngData);

        if ($qr === false) {
            return $pngData;
        }

        $qrW = imagesx($qr);
        $qrH = imagesy($qr);

        // Built-in GD font 5 → 9 px wide × 15 px tall per character
        $font = 5;
        $charW = imagefontwidth($font);
        $charH = imagefontheight($font);
        $padY = (int) round($qrH * 0.05);   // 5 % of QR height as top/bottom padding

        // Transcode UTF-8 → ISO-8859-1 so the degree sign renders correctly
        $encoded = function_exists('iconv')
            ? (string) iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $label)
            : $label;

        $textW = strlen($encoded) * $charW;
        $stripH = $charH + $padY * 2;

        $out = imagecreatetruecolor($qrW, $qrH + $stripH);

        if ($out === false) {
            imagedestroy($qr);

            return $pngData;
        }

        $white = imagecolorallocate($out, 255, 255, 255);
        $black = imagecolorallocate($out, 0, 0, 0);

        // White canvas, QR on top
        imagefill($out, 0, 0, $white);
        imagecopy($out, $qr, 0, 0, 0, 0, $qrW, $qrH);
        imagedestroy($qr);

        // Horizontally centred label
        $tx = max(0, (int) (($qrW - $textW) / 2));
        $ty = $qrH + $padY;
        imagestring($out, $font, $tx, $ty, $encoded, $black);

        ob_start();
        imagepng($out);
        $result = (string) ob_get_clean();
        imagedestroy($out);

        return $result;
    }
}