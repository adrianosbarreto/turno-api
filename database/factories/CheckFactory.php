<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Check;
use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;


class CheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Check::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $transaction = Income::inRandomOrder()->first();

        $account = Account::inRandomOrder()->first();

        if (!$transaction) {
            $transaction = Income::factory()->create();
        }

        $currentYear = date('Y');
        $startDate = "$currentYear-01-01 00:00:00";
        $endDate = "$currentYear-07-31 23:59:59";

        $status = $this->faker->randomElement(['pending', 'reject', 'accept']);

        return [
            'account_id' => $account->id,
            'income_id' => $status == 'accept' ? $transaction->id : null,
            'picture' => $this->faker->imageUrl(640, 480, 'business', true, 'Faker'),
            'amount' => $this->faker->randomFloat(2, 0, 10000),
            'description' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'status' => $status,
            'created_at' => $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
