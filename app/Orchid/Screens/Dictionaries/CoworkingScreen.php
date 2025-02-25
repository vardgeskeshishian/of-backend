<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\Coworking;
use App\Orchid\BaseTD;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class CoworkingScreen extends Screen
{
    private static string $tableName;

    public function __construct(public Coworking $model)
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
                ->with([
                    'rentBlock',
                    'coworkingOperatorType',
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
                BaseTD::make('working_place_count', __('general.table.working_place_count')),
                BaseTD::make('free_place_count', __('general.table.free_place_count')),

                BaseTD::make('coworking_operator_type_id', __('general.table.coworking_operator_type'))
                    ->render(fn(Coworking $model) => e($model->coworkingOperatorType?->name)),
            ]),
        ];
    }
}
