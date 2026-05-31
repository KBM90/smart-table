<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Services\QrCodeService;
use Illuminate\Http\Response;

class TableQrCodeController extends Controller
{
    public function __invoke(Table $table, QrCodeService $qrCodeService): Response
    {
        $this->authorize('view', $table);

        return response($qrCodeService->pngFor($table), 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="table-'.$table->id.'-qr.png"',
        ]);
    }
}
