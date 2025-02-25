<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SyncHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\SyncHistory>
 */
final class SyncHistoryFactory extends Factory
{
    private static int $iterator = 1;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SyncHistory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'data' => fake()->optional()->word,
            'error_message' => fake()->optional()->word,
            'status' => fake()->word,
        ];
    }
}
