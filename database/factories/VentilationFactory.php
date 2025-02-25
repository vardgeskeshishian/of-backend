<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Ventilation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Ventilation>
 */
final class VentilationFactory extends Factory
{
    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ventilation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 10000000),
            'name' => fake()->name,
        ];
    }
}
