<?php

namespace Database\Factories;

use App\Models\AgreementType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class AgreementTypeFactory extends Factory
{
    protected $model = AgreementType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'id' => $this->faker->unique()->numberBetween(1, 10000),
            'name' => $this->faker->word,
        ];
    }
}
