<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\MetroMultiple;
use App\Orchid\BaseTD;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class MetroMultipleScreen extends Screen
{
    private static string $tableName;

    public function __construct(public MetroMultiple $model)
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
                    'metroMultipleType',
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
                BaseTD::make('metro_multiple_types_id', __('general.table.metro_multiple_type'))
                    ->render(fn(MetroMultiple $model) => e($model->metroMultipleType->name)),

                BaseTD::make('metro_id', __('general.table.metro'))
                    ->render(fn(MetroMultiple $model) => e($model->metro?->name)),
            ]),
        ];
    }
}
