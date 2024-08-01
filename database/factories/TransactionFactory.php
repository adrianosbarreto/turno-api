<?php

namespace Database\Factories;

use App\Models\Account;
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

        $currentYear = date('Y');
        $startDate = "$currentYear-01-01 00:00:00";
        $endDate = "$currentYear-07-31 23:59:59";

        return [
            'transactable_type' => $type,
            'transactable_id' => $transactable->id,
            'account_id' => $account->id,
            'created_at' => $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
