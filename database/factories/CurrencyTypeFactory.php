<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CurrencyType;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CurrencyType>
 */
final class CurrencyTypeFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CurrencyType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $currencies = [
            ['RUB', 'Russian ruble'],
            ['USD', 'United States Dollar'],
            ['EUR', 'Euro'],
        ];
        $currency = fake()->randomElement($currencies);
        return [
            'id' => $this->generateUniqueId(),
            'name' => $currency[0],
            'code' => $currency[1],
            'ruble_exchange_rate' => fake()->randomFloat(5, 0, 99999),
        ];
    }
}
