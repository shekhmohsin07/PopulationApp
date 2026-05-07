<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Country::class;

    public function definition(): array
    {
        return [
            'country' => $this->faker->country(),
            'population' => $this->faker->numberBetween(1000000, 2000000000)
        ];
    }
}
