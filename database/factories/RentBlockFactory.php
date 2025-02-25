<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\RentBlock;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\RentBlock>
 */
final class RentBlockFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RentBlock::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->generateUniqueId(),
            'common_block_id' => \App\Models\CommonBlock::factory(),
            'is_coworking' => fake()->randomNumber(1),
            'price_meter_year_id' => \App\Models\Money::factory(),
            'operational_cost_id' => \App\Models\Money::factory(),
            'rent_block_tax_id' => \App\Models\RentBlockTax::factory(),
            'rent_contract_type_id' => \App\Models\RentContractType::factory(),
            'utility_costs_type_id' => \App\Models\UtilityCostsType::factory(),
            'contract_term_type_id' => \App\Models\ContractTermType::factory(),
            'deposit' => fake()->numberBetween(-8388608, 8388607),
        ];
    }
}
