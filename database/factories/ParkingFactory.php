<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Parking;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Parking>
 */
final class ParkingFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Parking::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->generateUniqueId(),
            'building_id' => \App\Models\Building::factory(),
            'currency_id' => \App\Models\CurrencyType::factory(),
            'type_id' => \App\Models\ParkingType::factory(),
            'count' => fake()->randomNumber(),
            'price' => fake()->randomFloat(),
            'nds' => fake()->randomNumber(1),
        ];
    }
}
