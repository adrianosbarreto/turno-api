<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(),
            'type' => $this->faker->randomElement(['customer', 'admin']),
            'account_number' => $this->faker->regexify('[0-9]{10}'),
            'current_balance' => $this->faker->randomFloat(2, 0, 10000),
            'user_name' => $this->faker->userName,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
