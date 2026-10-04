<?php

declare(strict_types=1);

namespace App\Registries;

use App\Contracts\PermissionContract;
use App\Enums\Authorization\Permissions\DashboardPermissions;
use App\Enums\Authorization\Permissions\GeneralPermissions;
use App\Enums\Authorization\Permissions\ModulePermissions;
use App\Enums\Authorization\Permissions\RolePermissions;
use App\Enums\Authorization\Permissions\UserPermissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Spatie\Permission\PermissionRegistrar;

final class PermissionRegistry
{
    /**
     * List all modular enum classes.
     *
     * @return array<int, class-string<PermissionContract>>
     */
    public static function modules(): array
    {
        return [
            ModulePermissions::class,
            DashboardPermissions::class,
            GeneralPermissions::class,
            UserPermissions::class,
            RolePermissions::class,
        ];
    }

    /**
     * Start a fluent collection chain for all permission enum cases.
     *
     * @return Collection<int, PermissionContract>
     */
    public static function collect(): Collection
    {
        /** @var Collection<int, PermissionContract> */
        return collect(self::modules())->flatMap(
            fn (string $enum): array => $enum::cases(),
        );
    }

    /**
     * Get permissions prepared specifically for database upsert.
     *
     * @return array<int, array{
     *     name: string,
     *     label: string,
     *     module: string,
     *     description: string,
     *     guard_name: string,
     *     created_at: Carbon,
     *     updated_at: Carbon
     * }>
     */
    public static function forUpsert(string $guardName = 'web'): array
    {
        $now = now();

        /** @var array<int, array{name: string, label: string, module: string, description: string, guard_name: string, created_at: Carbon, updated_at: Carbon}> */
        return self::collect()
            // ->reject(
            //     fn(PermissionContract $case): bool => $case ===
            //         GeneralPermissions::GENERAL,
            // )
            ->map(
                fn (PermissionContract $case): array => [
                    'name' => $case->value,
                    'label' => $case->label(),
                    'module' => $case->module(),
                    'description' => $case->description(),
                    'guard_name' => $guardName,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            )
            ->values()
            ->all();
    }

    /**
     * Synchronize permissions to database table.
     */
    public static function syncToDatabase(string $guardName = 'web'): void
    {
        $records = self::forUpsert($guardName);

        if (empty($records)) {
            return;
        }

        /** @var class-string<Model> $permissionModel */
        $permissionModel = config('permission.models.permission');

        $permissionModel::upsert(
            $records,
            ['name', 'guard_name'],
            ['label', 'module', 'description', 'updated_at'],
        );

        try {
            app(PermissionRegistrar::class)->forgetCachedPermissions();
        } catch (\Throwable $e) {
            // Ignore during initial database migration setups
        }
    }
}
