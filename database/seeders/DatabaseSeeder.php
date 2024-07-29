<?php

namespace Database\Seeders;

use App\Models\Check;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement("SET foreign_key_checks=0");

        User::truncate();
        Account::truncate();
        Transaction::truncate();
        Check::truncate();

        DB::statement("SET foreign_key_checks=1");


        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
        ]);

        $this->call([
            AccountTableSeeder::class,
            UserTableSeeder::class,
            TransactionsTableSeeder::class,
            ChecksTableSeeder::class,
        ]);
    }
}
