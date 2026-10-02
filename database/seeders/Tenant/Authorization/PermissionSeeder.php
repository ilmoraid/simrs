<?php

namespace Database\Seeders\Tenant\Authorization;

use App\Registries\PermissionRegistry;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Reset Spatie's cached permissions for this tenant connection
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // 2. Sync all Enum permissions to the tenant database
        PermissionRegistry::syncToDatabase(guardName: 'web');
    }
}
