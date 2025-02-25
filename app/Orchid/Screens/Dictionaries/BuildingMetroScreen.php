<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\BuildingMetro;
use App\Orchid\BaseTD;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class BuildingMetroScreen extends Screen
{
    private static string $tableName;

    public function __construct(public BuildingMetro $model)
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
                    'metro',
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
                BaseTD::make('building_id', 'Building')
                    ->render(fn(BuildingMetro $model) => e($model->building?->name)),

                BaseTD::make('metro_id', 'Metro')
                    ->render(fn(BuildingMetro $model) => e($model->metro?->name)),

                BaseTD::make('time_foot', __('general.table.time_foot')),

                BaseTD::make('time_car', __('general.table.time_car')),

            ]),
        ];
    }
}
