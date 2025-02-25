<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BuildingImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\BuildingImage>
 */
final class BuildingImageFactory extends Factory
{
    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuildingImage::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'building_id' => \App\Models\Building::factory(),
            'image_id' => \App\Models\Image::factory(),
            'type' => fake()->optional()->word,
            'sort_order' => fake()->randomNumber(),
        ];
    }
}
