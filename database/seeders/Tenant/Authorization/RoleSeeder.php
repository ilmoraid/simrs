<?php

namespace Database\Seeders\Tenant\Authorization;

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
        // Get all valid permissions synced by the registry
        $allPermissions = array_column(
            PermissionRegistry::forUpsert("web"),
            "name",
        );

        $roles = [
            [
                "name" => "Super Admin",
                "description" =>
                    "Highest level access. Complete control over all system features, user management, and platform configuration.",
                "is_system" => true,
            ],
            [
                "name" => "Admin",
                "description" =>
                    "Full access to all features and settings. Manage users, permissions, and system configuration.",
                "is_system" => true,
            ],
            [
                "name" => "Doctor",
                "description" =>
                    "Manages patient diagnoses, treatments, prescriptions, and medical records.",
                "is_system" => false,
            ],
            [
                "name" => "Pharmacist",
                "description" =>
                    "Handles medication dispensing, prescription fulfillment, and drug inventory management.",
                "is_system" => false,
            ],
            [
                "name" => "Registration Staff",
                "description" =>
                    "Manages patient registration, demographic data, and appointment scheduling.",
                "is_system" => false,
            ],
            [
                "name" => "Billing Staff",
                "description" =>
                    "Processes billing, invoices, insurance claims, and payment records.",
                "is_system" => false,
            ],
            [
                "name" => "Auditor",
                "description" =>
                    "Read-only access for audits, compliance reviews, and report verification.",
                "is_system" => false,
            ],
        ];

        foreach ($roles as $roleData) {
            $role = Role::firstOrCreate(
                ["name" => $roleData["name"], "guard_name" => "web"],
                [
                    "description" => $roleData["description"],
                    "is_system" => $roleData["is_system"],
                ],
            );

            // Assign full access to administrative roles
            if (in_array($role->name, ["Super Admin", "Admin"], true)) {
                $role->syncPermissions($allPermissions);
            }
        }
    }
}
