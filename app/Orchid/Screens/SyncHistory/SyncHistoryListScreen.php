<?php

declare(strict_types=1);

namespace App\Orchid\Screens\SyncHistory;

use App\Models\SyncHistory;
use App\Orchid\Layouts\SyncHistory\SyncHistoryListLayout;
use App\Services\SyncHistoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SyncHistoryListScreen extends Screen
{
    /**
     * A method that defines all screen input data
     * is in it that database queries should be called,
     * api or any others (not necessarily explicit),
     * the result of which should be an array,
     * appeal to which his keys will be used.
     */
    public function query(): array
    {
        return ['histories' => SyncHistory::query()->paginate(10)];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    #[\Override]
    public function name(): ?string
    {
        return __("DB synchronization history");
    }

    /**
     * The description is displayed on the user's screen under the heading
     */

    /**
     * Identifies control buttons and events.
     * which will have to happen by pressing
     */

    #[\Override]
    public function commandBar(): iterable
    {
        return [
        ];
    }

    /**
     * Set of mappings
     * rows, tables, graphs,
     * modal windows, and their combinations
     */
    #[\Override]
    public function layout(): array
    {
        return [
            SyncHistoryListLayout::class,
        ];
    }

    public function exportToCSV(Request $request, SyncHistoryService $service): StreamedResponse|RedirectResponse
    {
        try {
            /** @var SyncHistory $history */
            $history = SyncHistory::query()
                ->findOrFail($request->get('record_id'));

            /** @var array $headers */
            $headers = (new SyncHistory())->getFillable();

            $historyArray = Arr::only($history->toArray(), $headers);

            $historyArray['data'] = json_encode($historyArray['data']);

            $handle = fopen('php://output', 'w');

            fputcsv($handle, $headers);
            fputcsv($handle, $historyArray);
            fclose($handle);

            return response()->streamDownload(function () use ($handle): void {}, "CSV-ID-{$history->id}.csv");

        } catch (\Exception $e) {
            Toast::error(__('Something went wrong: ') . $e->getMessage())->delay(2000);
            return redirect()->back();
        }
    }


    public function exportToJSON(Request $request): StreamedResponse|RedirectResponse
    {
        try {
            /** @var SyncHistory $history */
            $history = SyncHistory::query()
                ->findOrFail($request->get('record_id'));

            return response()->streamDownload(function () use ($history): void {
                $handle = fopen('php://output', 'w');
                fwrite($handle, $history->toJson(JSON_PRETTY_PRINT));
                fclose($handle);
            }, "TXT-ID-{$history->id}.txt");
        } catch (\Exception $e) {
            Toast::error(__('Something went wrong: ') . $e->getMessage())->delay(2000);
            return redirect()->back();
        }
    }
}
