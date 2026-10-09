<?php

namespace Database\Seeders\Tenant\User;

use App\Enums\Authorization\Roles\UserRoles;
use App\Models\Authentication\User;
use App\Models\Authorization\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory([
            "email" => "admin@ilmora.id",
        ])->create();
        $administrator = User::factory([
            "email" => "administrator@ilmora.id",
        ])->create();

        $admin->assignRole(UserRoles::ADMIN);
        $administrator->assignRole(UserRoles::ADMINISTRATOR);

        $roles = Role::query()->get()->pluck("name");

        User::factory()
            ->unverified()
            ->count(50)
            ->make()
            ->each(function (User $user) use ($roles) {
                $user->assignRole($roles->random());
                $user->save();
            });
    }
}
