<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\Building;
use App\Orchid\BaseTD;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class BuildingScreen extends Screen
{
    private static string $tableName;

    public function __construct(public Building $model)
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
                    'assignment',
                    'classCode',
                    'provider',
                    'conditioning',
                    'fireAlarm',
                    'security',
                    'districtType',
                    'administrativeDistrictType',
                    'exteriorWallType',
                    'overlapType',
                    'lawType',
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
                BaseTD::make('eng_name', __('general.table.eng_name')),
                BaseTD::make('gross_boma_area', __('general.table.gross_boma_area')),
                BaseTD::make('gross_leasable_area', __('general.table.gross_leasable_area')),
                BaseTD::make('land_area', __('general.table.land_area')),
                BaseTD::make('address', __('general.table.address')),
                BaseTD::make('floors_count', __('general.table.floors_count')),
                BaseTD::make('build_year', __('general.table.build_year')),
                BaseTD::make('freight_elevators', __('general.table.freight_elevators')),
                BaseTD::make('passenger_elevators', __('general.table.passenger_elevators')),
                BaseTD::make('taxes_department_number', __('general.table.taxes_department_number')),
                BaseTD::make('parking_coefficient_is_unlimited', __('general.table.parking_coefficient_is_unlimited')),
                BaseTD::make('coefficient_first_value', __('general.table.coefficient_first_value')),
                BaseTD::make('coefficient_last_value', __('general.table.coefficient_last_value')),
                BaseTD::make('was_moderated', __('general.table.was_moderated'))->bool(),
                BaseTD::make('is_export_sites', __('general.table.is_export_sites'))->bool(),
                BaseTD::make('is_new_construction', __('general.table.is_new_construction'))->bool(),
                BaseTD::make('is_object_cultural_heritage', __('general.table.is_object_cultural_heritage'))->bool(),
                BaseTD::make('commissioning_year', __('general.table.commissioning_year')),
                BaseTD::make('commissioning_quarter', __('general.table.commissioning_quarter')),
                BaseTD::make('cadastral_number', __('general.table.cadastral_number')),
                BaseTD::make('cadastral_land_number', __('general.table.cadastral_land_number')),
                BaseTD::make('land_contract_date', __('general.table.land_contract_date')),
                BaseTD::make('operating_costs_without_nds', __('general.table.operating_costs_without_nds')),
                BaseTD::make('year_reconstruction', __('general.table.year_reconstruction')),
                BaseTD::make('ensemble_name', __('general.table.ensemble_name')),
                BaseTD::make('built_up_area', __('general.table.built_up_area')),
                BaseTD::make('underground_floors_count', __('general.table.underground_floors_count')),
                BaseTD::make('permitted_use_of_land_plot', __('general.table.permitted_use_of_land_plot')),

                BaseTD::make('assignment_id', __('general.table.assignment'))
                    ->render(fn(Building $model) => e($model->assignment?->name)),

                BaseTD::make('class_code_id', __('general.table.class_code'))
                    ->render(fn(Building $model) => e($model->classCode?->name)),

                BaseTD::make('provider_id', __('general.table.provider'))
                    ->render(fn(Building $model) => e($model->provider?->name)),

                BaseTD::make('conditioning_id', __('general.table.conditioning'))
                    ->render(fn(Building $model) => e($model->conditioning?->name)),

                BaseTD::make('fire_alarm_id', __('general.table.fire_alarm'))
                    ->render(fn(Building $model) => e($model->fireAlarm?->name)),

                BaseTD::make('security_id', __('general.table.security'))
                    ->render(fn(Building $model) => e($model->security?->name)),

                BaseTD::make('district_type_id', __('general.table.district_type'))
                    ->render(fn(Building $model) => e($model->districtType?->name)),

                BaseTD::make('administrative_district_type_id', __('general.table.administrative_district_type'))
                    ->render(fn(Building $model) => e($model->administrativeDistrictType?->name)),

                BaseTD::make('exterior_wall_type_id', __('general.table.exterior_wall_type'))
                    ->render(fn(Building $model) => e($model->exteriorWallType?->name)),

                BaseTD::make('overlap_type_id', __('general.table.overlap_type'))
                    ->render(fn(Building $model) => e($model->overlapType?->name)),

                BaseTD::make('law_type_id', __('general.table.law_type_id'))
                    ->render(fn(Building $model) => e($model->lawType?->name)),

                BaseTD::make('created_at', __('general.table.created_at'))
                    ->usingComponent(DateTimeSplit::class)
                    ->sort(),

                BaseTD::make('updated_at', __('general.table.updated_at'))
                    ->usingComponent(DateTimeSplit::class),
            ]),
        ];
    }
}
