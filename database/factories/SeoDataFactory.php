<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SeoData;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\SeoData>
 */
final class SeoDataFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SeoData::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->generateUniqueId(),
            'url' => fake()->optional()->url,
            'h1' => fake()->optional()->word,
            'title' => fake()->optional()->title,
            'description' => fake()->optional()->text,
            'keywords' => fake()->optional()->word,
            'breadcrumbs' => fake()->optional()->word,
            'text_top' => fake()->word,
            'text_bottom' => fake()->word,
        ];
    }
}
