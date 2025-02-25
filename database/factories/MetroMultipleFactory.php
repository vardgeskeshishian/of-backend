<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\MetroMultiple;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\MetroMultiple>
 */
final class MetroMultipleFactory extends Factory
{
    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MetroMultiple::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'metro_multiple_types_id' => \App\Models\MetroMultipleTypes::factory(),
            'metro_id' => \App\Models\Metro::factory(),
        ];
    }
}
