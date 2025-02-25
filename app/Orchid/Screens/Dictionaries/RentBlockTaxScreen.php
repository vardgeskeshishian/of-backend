<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\RentBlockTax;
use App\Orchid\BaseTD;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class RentBlockTaxScreen extends Screen
{
    private static string $tableName;

    public function __construct(public RentBlockTax $model)
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
                    'taxType',
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
                BaseTD::make('tax_type_id', __('general.table.tax_type'))
                    ->render(fn(RentBlockTax $model) => e($model->taxType?->name)),

                BaseTD::make('created_at', __('general.table.created_at'))
                    ->usingComponent(DateTimeSplit::class)
                    ->sort(),

                BaseTD::make('updated_at', __('general.table.updated_at'))
                    ->usingComponent(DateTimeSplit::class),
            ]),
        ];
    }
}
