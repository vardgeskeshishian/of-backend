<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Building;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Building>
 */
final class BuildingFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Building::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {

        return [
            'id' => $this->generateUniqueId(),
            'name' => fake()->optional()->name,
            'eng_name' => fake()->optional()->word,
            'gross_boma_area' => fake()->randomNumber(),
            'gross_leasable_area' => fake()->randomNumber(),
            'land_area' => fake()->randomNumber(),
            'floors_count' => fake()->randomNumber(1),
            'build_year' => fake()->numberBetween(1, 1),
            'address' => fake()->word,
            'coordinates' => fake()->localCoordinates,
            'freight_elevators' => fake()->numberBetween(1, 1),
            'passenger_elevators' => fake()->numberBetween(1, 100),
            'taxes_department_number' => fake()->optional()->word,
            'assignment_id' => \App\Models\Assignment::factory(),
            'class_code_id' => \App\Models\ClassCode::factory(),
            'provider_id' => \App\Models\Provider::factory(),
            'conditioning_id' => \App\Models\Conditioning::factory(),
            'fire_alarm_id' => \App\Models\FireAlarm::factory(),
            'security_id' => \App\Models\Security::factory(),
            'ventilation_id' => \App\Models\Ventilation::factory(),
            'parking_coefficient_is_unlimited' => fake()->randomNumber(1),
            'coefficient_first_value' => fake()->optional()->randomNumber(),
            'coefficient_last_value' => fake()->optional()->randomNumber(),
            'was_moderated' => fake()->randomNumber(1),
            'is_export_sites' => fake()->randomNumber(1),
            'is_new_construction' => fake()->randomNumber(1),
            'commissioning_year' => 1,
            'commissioning_quarter' => 1,
            'cadastral_number' => fake()->optional()->word,
            'cadastral_land_number' => fake()->optional()->word,
            'land_contract_date' => fake()->optional()->date(),
            'district_type_id' => \App\Models\DistrictType::factory(),
            'operating_costs_without_nds' => fake()->optional()->randomNumber(),
            'year_reconstruction' => fake()->optional()->randomNumber(),
            'is_object_cultural_heritage' => fake()->randomNumber(1),
            'ensemble_name' => fake()->optional()->word,
            'built_up_area' => fake()->optional()->randomNumber(),
            'underground_floors_count' => fake()->optional()->randomNumber(),
            'permitted_use_of_land_plot' => fake()->optional()->text,
            'administrative_district_type_id' => \App\Models\AdministrativeDistrictType::factory(),
            'exterior_wall_type_id' => \App\Models\ExteriorWallType::factory(),
            'overlap_type_id' => \App\Models\OverlapType::factory(),
            'law_type_id' => \App\Models\LawType::factory(),
        ];
    }
}
