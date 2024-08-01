<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Income::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currentYear = date('Y');
        $startDate = "$currentYear-01-01 00:00:00";
        $endDate = "$currentYear-07-31 23:59:59";

        return [
            'amount' => $this->faker->randomFloat(2, 0, 10000),
            'description' => $this->faker->sentence(),
            'created_at' => $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d H:i:s'),
        ];
    }
}
