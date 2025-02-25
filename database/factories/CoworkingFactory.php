<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Coworking;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Coworking>
 */
final class CoworkingFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coworking::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->generateUniqueId(),
            'rent_block_id' => \App\Models\RentBlock::factory(),
            'coworking_operator_type_id' => \App\Models\CoworkingOperatorType::factory(),
            'working_place_count' => fake()->numberBetween(-32768, 32767),
            'free_place_count' => fake()->numberBetween(-32768, 32767),
        ];
    }
}
