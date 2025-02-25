<?php

namespace App\Orchid\Screens;

use App\Models\Building;
use App\Models\RentBlock;
use App\Models\SaleBlock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use OpenApi\Generator;

class MainScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'metrics' => [
                'buildings' => ['value' => Building::count(), 'diff' => 0],
                'rent_blocks' => ['value' => RentBlock::count(), 'diff' => 0],
                'sale_blocks' => ['value' => SaleBlock::count(), 'diff' => 0],
                'total' => number_format(65661),
            ],
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    #[\Override]
    public function name(): ?string
    {
        return __('general.main');
    }

    /**
     * Display header description.
     */
    #[\Override]
    public function description(): ?string
    {
        return __('general.metrics');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    #[\Override]
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Regenerate API doc'))
                ->icon('bs.repeat')
                ->method('regenerate'),

            Link::make('')
                ->icon('bs.box-arrow-up-right')
                ->target('_blank')
                ->href(config('app.url') . '/' . config('l5-swagger.documentations.default.routes.api')),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    #[\Override]
    public function layout(): iterable
    {
        return [
            Layout::metrics([
                __('general.building') => 'metrics.buildings',
                __('general.rent_block') => 'metrics.rent_blocks',
                __('general.sale_block') => 'metrics.sale_blocks',
                'Total Earnings' => 'metrics.total',
            ]),
        ];
    }

    public function regenerate(): RedirectResponse
    {
        try {
            $scanPath = base_path('app');

            $openapi = Generator::scan([$scanPath]);

            $outputPath = storage_path('api-docs/api-docs.json');

            file_put_contents($outputPath, $openapi->toJson());

            Artisan::call('app:update-swagger-servers');

            Toast::info(__('Documentation is regenerated.'));
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            Toast::error(__('Documentation is not regenerated.'));
        }

        return redirect()->back();
    }
}
