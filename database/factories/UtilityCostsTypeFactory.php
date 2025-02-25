<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UtilityCostsType;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\UtilityCostsType>
 */
final class UtilityCostsTypeFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UtilityCostsType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->generateUniqueId(),
            'name' => fake()->name,
        ];
    }
}
