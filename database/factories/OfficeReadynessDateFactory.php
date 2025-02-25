<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\OfficeReadynessDate;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\OfficeReadynessDate>
 */
final class OfficeReadynessDateFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OfficeReadynessDate::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->generateUniqueId(),
            'common_block_id' => \App\Models\CommonBlock::factory(),
            'date' => fake()->date(),
        ];
    }
}
