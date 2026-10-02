<?php

namespace Database\Seeders\Tenant\Authorization;

use App\Enums\Authorization\Roles\UserRoles;
use App\Models\Authorization\Role;
use App\Registries\PermissionRegistry;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allPermissions = array_column(
            PermissionRegistry::forUpsert("web"),
            "name",
        );

        foreach (UserRoles::cases() as $roleEnum) {
            $role = Role::firstOrCreate(
                ["name" => $roleEnum->value, "guard_name" => "web"],
                [
                    "description" => $roleEnum->description(),
                    "is_system" => $roleEnum->isSystem(),
                ],
            );

            // Assign full permissions to administrative roles
            if (
                $roleEnum === UserRoles::SUPER_ADMIN ||
                $roleEnum === UserRoles::ADMIN
            ) {
                $role->syncPermissions($allPermissions);
            }
        }
    }
}
