<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BuildingInfrastructureType;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\BuildingInfrastructureType>
 */
final class BuildingInfrastructureTypeFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuildingInfrastructureType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->generateUniqueId(),
            'building_id' => \App\Models\Building::factory(),
            'infrastructure_type_id' => \App\Models\InfrastructureType::factory(),
        ];
    }
}
