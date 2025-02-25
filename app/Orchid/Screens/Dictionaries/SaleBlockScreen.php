<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\SaleBlock;
use App\Orchid\BaseTD;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class SaleBlockScreen extends Screen
{
    private static string $tableName;

    public function __construct(public SaleBlock $model)
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
                    'commonBlock',
                    'saleBlockTax',
                    'pricePerMeter',
                    'creator',
                    'saleContractType',
                    'targetSalesType',
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
                BaseTD::make('common_block_id', __('general.table.building'))
                    ->render(fn(SaleBlock $model) => e($model->commonBlock?->name)),

                BaseTD::make('sale_contract_type_id', __('general.table.type'))
                    ->render(fn(SaleBlock $model) => e($model->saleContractType?->name)),

                BaseTD::make('target_sales_type_id', __('general.table.target_sales_type'))
                    ->render(fn(SaleBlock $model) => e($model->targetSalesType?->name)),

                BaseTD::make('is_juridical_saller', __('general.table.is_juridical_saller'))
                    ->bool(),

                BaseTD::make('created_at', __('general.table.created_at'))
                    ->usingComponent(DateTimeSplit::class)
                    ->sort(),

                BaseTD::make('updated_at', __('general.table.updated_at'))
                    ->usingComponent(DateTimeSplit::class),
            ]),
        ];
    }
}
