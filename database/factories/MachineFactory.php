<?php

namespace Database\Factories;

use App\Models\Machine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Machine>
 */
class MachineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Machine::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'purchase_date' => $this->faker->date,
            'price' => $this->faker->randomFloat(2, 100, 10000),
            'brand' => $this->faker->randomElement([1, 2, 3]),
            'status' => $this->faker->randomElement([0, 1]),
            'sort_order' => $this->faker->numberBetween(1, 100),
        ];
    }
}
