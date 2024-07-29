<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Check;
use App\Models\Expense;
use App\Models\Income;
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
        $account = Account::inRandomOrder()->first();

        $type = $this->faker->randomElement(['income', 'expense']);

        if ($type == 'income') {
            $transactable = Income::factory()->create();
        } else {
            $transactable = Expense::factory()->create();
        }

        return [
            'transactable_type' => $type,
            'transactable_id' => $transactable->id,
            'account_id' => $account->id,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
