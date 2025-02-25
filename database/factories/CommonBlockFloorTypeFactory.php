<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CommonBlockFloorType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CommonBlockFloorType>
 */
final class CommonBlockFloorTypeFactory extends Factory
{
    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommonBlockFloorType::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'common_block_id' => \App\Models\CommonBlock::factory(),
            'floor_type_id' => \App\Models\FloorType::factory(),
        ];
    }
}
