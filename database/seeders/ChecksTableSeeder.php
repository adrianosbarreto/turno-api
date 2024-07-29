<?php

namespace Database\Seeders;

use App\Models\Check;
use Illuminate\Database\Seeder;

class ChecksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Check::factory()->count(50)->create();
    }
}
