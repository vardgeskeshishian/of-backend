<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\MetroMetroLine;
use App\Traits\FactoryUniqueValueGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\MetroMetroLine>
 */
final class MetroMetroLineFactory extends Factory
{
    use FactoryUniqueValueGenerator;

    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MetroMetroLine::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->generateUniqueId(),
            'metro_id' => \App\Models\Metro::factory(),
            'metro_line_id' => \App\Models\MetroLine::factory(),
        ];
    }
}
