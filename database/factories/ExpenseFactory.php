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
        return [
            'amount' => $this->faker->randomFloat(2, 0, 10000), // Gera um valor decimal entre 0 e 10000
            'description' => $this->faker->sentence(), // Gera uma frase aleatória
        ];
    }
}
