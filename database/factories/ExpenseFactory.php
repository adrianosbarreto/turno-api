<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Expense::class;

    public function definition(): array
    {
        $currentYear = date('Y');
        $startDate = "$currentYear-01-01 00:00:00";
        $endDate = "$currentYear-07-31 23:59:59";

        return [
            'amount' => $this->faker->randomFloat(2, 0, 10000), // Gera um valor decimal entre 0 e 10000
            'description' => $this->faker->sentence(), // Gera uma frase aleatória
            'created_at' => $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d H:i:s'),
        ];
    }
}
