<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\RentBlock;
use App\Orchid\BaseTD;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class RentBlockScreen extends Screen
{
    private static string $tableName;

    public function __construct(public RentBlock $model)
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
                    'priceMeterYear',
                    'operationalCost',
                    'rentBlockTax',
                    'rentContractType',
                    'utilityCostsType',
                    'contractTermType',
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
                BaseTD::make('is_coworking', __('general.table.is_coworking'))->bool(),
                BaseTD::make('deposit', __('general.table.eng_name')),

                BaseTD::make('common_block_id', __('general.table.common_block'))
                    ->render(fn(RentBlock $model) => e($model->commonBlock?->name)),

                BaseTD::make('price_meter_year_id', __('general.table.price_meter_year'))
                    ->render(fn(RentBlock $model) => e($model->priceMeterYear?->value)),

                BaseTD::make('operational_cost_id', __('general.table.operational_cost'))
                    ->render(fn(RentBlock $model) => e($model->operationalCost?->value)),

                BaseTD::make('rent_contract_type_id', __('general.table.rent_contract_type'))
                    ->render(fn(RentBlock $model) => e($model->rentContractType?->name)),

                BaseTD::make('utility_costs_type_id', __('general.table.utility_costs_type'))
                    ->render(fn(RentBlock $model) => e($model->utilityCostsType?->name)),

                BaseTD::make('contract_term_type_id', __('general.table.contract_term_type'))
                    ->render(fn(RentBlock $model) => e($model->contractTermType?->name)),
            ]),
        ];
    }
}
