<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\Parking;
use App\Orchid\BaseTD;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ParkingScreen extends Screen
{
    private static string $tableName;

    public function __construct(public Parking $model)
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
                    'building',
                    'currencyType',
                    'parkingType',
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
     * @throws \ReflectionException
     */
    #[\Override]
    public function layout(): iterable
    {
        return [
            Layout::table(self::$tableName, [
                BaseTD::make('building_id', __('general.table.building'))
                    ->render(fn(Parking $model) => e($model->building?->name)),

                BaseTD::make('currency_id', __('general.table.currency'))
                    ->render(fn(Parking $model) => e($model->currencyType?->name)),

                BaseTD::make('type_id', __('general.table.type'))
                    ->render(fn(Parking $model) => e($model->parkingType?->name)),

                BaseTD::make('count', __('general.table.count')),
                BaseTD::make('price', __('general.table.price')),
                BaseTD::make('nds', __('general.table.nds')),
            ]),
        ];
    }
}
