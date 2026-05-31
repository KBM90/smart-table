<?php

namespace App\Livewire\Owner\Tables;

use App\Models\Table;
use App\Services\QrCodeService;
use Livewire\Component;

class QrPreview extends Component
{
    public int $tableId;

    public function render(QrCodeService $qrCodeService)
    {
        $table = Table::query()->findOrFail($this->tableId);
        $this->authorize('view', $table);

        return view('livewire.owner.tables.qr-preview', [
            'table' => $table,
            'qrDataUrl' => $qrCodeService->dataUrlFor($table),
        ]);
    }
}
