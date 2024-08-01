<?php

namespace Database\Seeders;

use App\Models\Check;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $permissions = [
            'check-control',
        ];

        $roles = [
            'admin',
            'customer',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }

        foreach ($roles as $role) {
            $roleAdmin = Role::create([
                'name' => $role,
                'guard_name' => 'api'
            ]);

            if($role == 'admin'){
                $roleAdmin->syncPermissions($permissions);
            }
        }


        DB::statement("SET foreign_key_checks=0");

        User::truncate();
        Account::truncate();
        Transaction::truncate();
        Check::truncate();

        DB::statement("SET foreign_key_checks=1");


        $admin = User::factory()->create([
            'username' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        Account::factory()->create([
            'user_id' => $admin->id,
            'current_balance' => 0,
        ]);

        $admin->assignRole('admin');

        $this->call([
            AccountTableSeeder::class,
            UserTableSeeder::class,
            TransactionsTableSeeder::class,
            ChecksTableSeeder::class,
        ]);
    }
}
