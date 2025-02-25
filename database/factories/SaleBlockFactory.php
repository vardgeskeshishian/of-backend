<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SaleBlock;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\SaleBlock>
 */
final class SaleBlockFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SaleBlock::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->generateUniqueId(),
            'common_block_id' => \App\Models\CommonBlock::factory(),
            'sale_block_tax_id' => \App\Models\SaleBlockTax::factory(),
            'price_per_meter_id' => \App\Models\Money::factory(),
            'is_juridical_saller' => fake()->randomNumber(1),
            'sale_contract_type_id' => \App\Models\SaleContractType::factory(),
            'target_sales_type_id' => \App\Models\TargetSalesType::factory(),
        ];
    }
}
