<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        $user = User::inRandomOrder()->first();

        if (!$user) {
            $user = User::factory()->create();
        }

        return [
            'user_id' => $user->id,
            'type' => $this->faker->randomElement(['expense', 'income']),
            'amount' => $this->faker->randomFloat(2, 0, 10000),
            'date' => $this->faker->date('Y-m-d'),
            'description' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
