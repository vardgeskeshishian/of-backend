<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Money;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Money>
 */
final class MoneyFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Money::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->generateUniqueId(),
            'value' => fake()->numberBetween(100000, 5000000000),
            'currency_type_id' => \App\Models\CurrencyType::factory(),
        ];
    }
}
