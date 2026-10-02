<?php

namespace Database\Seeders;

use Database\Seeders\Tenant\Authorization\PermissionSeeder;
use Database\Seeders\Tenant\Authorization\RoleSeeder;
use Database\Seeders\Tenant\User\UserSeeder;
use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** Create Permissions */
        $this->call(PermissionSeeder::class);

        /** Create Roles */
        $this->call(RoleSeeder::class);

        /** Create Users */
        $this->call(UserSeeder::class);
    }
}
