<?php

namespace App\Services;

use App\Models\SyncHistory;

class SyncHistoryService
{
    public function record(string $status, array $data, string $errorMessage = null): void
    {
        SyncHistory::create([
            'status' => $status,
            'error_message' => $errorMessage,
            'data' => $data,
        ]);
    }

}
