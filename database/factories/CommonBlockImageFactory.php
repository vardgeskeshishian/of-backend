<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CommonBlockImage;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CommonBlockImage>
 */
final class CommonBlockImageFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommonBlockImage::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->generateUniqueId(),
            'common_block_id' => \App\Models\CommonBlock::factory(),
            'image_id' => \App\Models\Image::factory(),
            'image_type' => fake()->optional()->word,
            'sort_order' => fake()->randomNumber(),
        ];
    }
}
