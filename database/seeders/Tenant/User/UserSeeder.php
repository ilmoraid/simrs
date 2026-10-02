<?php

namespace Database\Seeders\Tenant\User;

use App\Enums\Authorization\Roles\UserRoles;
use App\Models\Authentication\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory([
            'email' => 'admin@ilmora.id',
        ])->create();

        User::factory()->unverified()->count(5)->create();

        $admin->assignRole(UserRoles::ADMIN);
    }
}
