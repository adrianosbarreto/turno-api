<?php

namespace Database\Factories;

use App\Models\Check;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Transaction;

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
        $transaction = Transaction::inRandomOrder()->first();

        if (!$transaction) {
            $transaction = Transaction::factory()->create();
        }

        $status = $this->faker->randomElement(['pending', 'reject', 'accept']);

        return [
            'transaction_id' => $status == 'accept' ? $transaction->id : null,
            'user_id' => $transaction->user_id,
            'picture' => $this->faker->imageUrl(640, 480, 'business', true, 'Faker'),
            'amount' => $this->faker->randomFloat(2, 0, 10000),
            'description' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'status' => $status,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
