<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BuildingMetro;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\BuildingMetro>
 */
final class BuildingMetroFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuildingMetro::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->generateUniqueId(),
            'building_id' => \App\Models\Building::factory(),
            'metro_id' => \App\Models\Metro::factory(),
            'time_foot' => fake()->optional()->randomNumber(),
            'time_car' => fake()->optional()->randomNumber(),
        ];
    }
}
