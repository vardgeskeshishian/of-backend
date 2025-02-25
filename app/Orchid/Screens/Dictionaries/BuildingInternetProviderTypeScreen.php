<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\BuildingInternetProviderType;
use App\Orchid\BaseTD;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class BuildingInternetProviderTypeScreen extends Screen
{
    private static string $tableName;

    public function __construct(public BuildingInternetProviderType $model)
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
                    'internetProviderType',
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
                BaseTD::make('building_id', __('general.table.building'))
                    ->render(fn(BuildingInternetProviderType $model) => e($model->building?->name)),
                BaseTD::make('internet_provider_type_id', __('general.table.internet_provider_type'))
                    ->render(fn(BuildingInternetProviderType $model) => e($model->internetProviderType?->name)),
            ]),
        ];
    }
}
