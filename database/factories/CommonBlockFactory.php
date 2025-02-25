<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CommonBlock;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CommonBlock>
 */
final class CommonBlockFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommonBlock::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->generateUniqueId(),
            'building_id' => \App\Models\Building::factory(),
            'name' => fake()->optional()->name,
            'is_available' => fake()->randomNumber(1),
            'is_negotiable_price' => fake()->randomNumber(1),
            'commission_amount_percent' => fake()->randomFloat(2, 0, 999),
            'is_export_sites' => fake()->randomNumber(1),
            'is_export_markets' => fake()->randomNumber(1),
            'is_full_building' => fake()->randomNumber(1),
            'is_floor_range' => fake()->randomNumber(1),
            'owner_id' => \App\Models\User::factory(),
            'min_area' => fake()->numberBetween(0, 1000),
            'max_area' => fake()->numberBetween(1001, 32767),
            'useful_area' => 1,
            'electric_power' => 1,
            'max_parking_size' => 1,
            'block_type_id' => \App\Models\BlockType::factory(),
            'office_layout_type_id' => \App\Models\OfficeLayoutType::factory(),
            'office_readyness_type_id' => \App\Models\OfficeReadynessType::factory(),
            'is_street_entrance' => fake()->optional()->randomNumber(1),
            'is_separate_entrance' => fake()->randomNumber(1),
            'is_furnished' => fake()->boolean(),
            'inner_text' => fake()->text,
            'site_text' => fake()->text,
            'presentation_description' => fake()->text,
            'is_for_vacation' => fake()->boolean(),
        ];
    }
}
