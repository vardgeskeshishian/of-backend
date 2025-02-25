<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\SyncHistory;

use App\Models\SyncHistory;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SyncHistoryListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'histories';

    /**
     * @return TD[]
     */
    #[\Override]
    public function columns(): array
    {
        return [
            TD::make('id', __('ID')),

            TD::make('status', __('Synchronization status'))
                ->render(fn($history) => $history->status === 'success' ? __('Success') : __('Error')),

            TD::make('error_message', __('Error message'))
                ->defaultHidden(),

            TD::make('created_at', __('Synchronization data'))
                ->render(fn($history) => $history->created_at->format('d.m.Y H:i:s')),
            TD::make('exportCSV', __('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(
                    fn(SyncHistory $history) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Button::make()
                            ->name(__('general.export') . ' CSV')
                            ->icon('cloud-download')
                            ->method('exportToCSV')
                            ->parameters(['record_id' => $history->id])
                            ->rawClick(),

                        Button::make()
                            ->name(__('general.export') . ' TXT(JSON)')
                            ->icon('cloud-download')
                            ->method('exportToJSON')
                            ->parameters(['record_id' => $history->id])
                            ->rawClick(),
                    ]),
                ),
        ];
    }

}
