<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\CommonBlock;
use App\Orchid\BaseTD;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class CommonBlockScreen extends Screen
{
    private static string $tableName;

    public function __construct(public CommonBlock $model)
    {
        self::$tableName = $model->getTable();
    }

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            self::$tableName => $this->model::query()
                ->filters()
                ->with([
                    'officeLayoutType',
                    'minNegotiablePrice',
                    'building',
                    'blockType',
                    'officeReadynessType',
                    'owner',
                ])
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    #[\Override]
    public function name(): ?string
    {
        $action = new GetTableCommentAction();

        return $action($this->model);
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
            //
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     *
     * @throws \ReflectionException
     */
    #[\Override]
    public function layout(): iterable
    {
        return [
            Layout::table(self::$tableName, [
                BaseTD::make('name', __('general.table.name')),
                BaseTD::make('min_area', __('general.table.min_area')),
                BaseTD::make('is_available', __('general.table.is_available')),
                BaseTD::make('commission_amount_percent', __('general.table.commission_amount_percent')),
                BaseTD::make('inner_text', __('general.table.inner_text')),
                BaseTD::make('is_floor_range', __('general.table.is_floor_range')),
                BaseTD::make('is_export_markets', __('general.table.is_export_markets')),
                BaseTD::make('owner_id', __('general.table.owner')),
                BaseTD::make('site_text', __('general.table.site_text')),
                BaseTD::make('is_street_entrance', __('general.table.is_street_entrance'))->bool(),
                BaseTD::make('is_furnished', __('general.table.is_furnished'))->bool(),
                BaseTD::make('max_parking_size', __('general.table.max_parking_size')),
                BaseTD::make('is_export_sites', __('general.table.is_export_sites'))->bool(),
                BaseTD::make('is_separate_entrance', __('general.table.is_separate_entrance'))->bool(),
                BaseTD::make('is_negotiable_price', __('general.table.is_negotiable_price'))->bool(),
                BaseTD::make('is_full_building', __('general.table.is_full_building'))->bool(),
                BaseTD::make('is_for_vacation', __('general.table.is_for_vacation'))->bool(),
                BaseTD::make('electric_power', __('general.table.electric_power')),
                BaseTD::make('max_area', __('general.table.max_area')),
                BaseTD::make('useful_area', __('general.table.useful_area')),

                BaseTD::make('office_layout_type_id', __('general.table.office_layout_type'))
                    ->render(fn(CommonBlock $model) => e($model->officeLayoutType?->name)),

                BaseTD::make('building_id', __('general.table.building'))
                    ->render(fn(CommonBlock $model) => e($model->building?->name)),

                BaseTD::make('block_type_id', __('general.table.block_type'))
                    ->render(fn(CommonBlock $model) => e($model->blockType?->name)),

                BaseTD::make('office_readyness_type_id', __('general.table.office_readyness_type'))
                    ->render(fn(CommonBlock $model) => e($model->officeReadynessType?->name)),

                BaseTD::make('owner_id', __('general.table.owner'))
                    ->render(fn(CommonBlock $model) => e($model->owner?->name)),
            ]),
        ];
    }
}
