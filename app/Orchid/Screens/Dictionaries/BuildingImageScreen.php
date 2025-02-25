<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\BuildingImage;
use App\Orchid\BaseTD;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class BuildingImageScreen extends Screen
{
    private static string $tableName;

    public function __construct(public BuildingImage $model)
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
                    'image',
                    'building',
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
                    ->render(fn(BuildingImage $model) => e($model->building?->name)),

                BaseTD::make('image_id', __('general.table.image'))
                    ->render(fn(BuildingImage $model) => view('orchid.components.image', [
                        'url' => $model->image?->url,
                    ])),

                BaseTD::make('type', __('general.table.type')),
                BaseTD::make('sort_order', __('general.table.sort_order')),
            ]),
        ];
    }
}
