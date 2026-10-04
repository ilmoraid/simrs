<?php

declare(strict_types=1);

namespace App\Enums\Authorization\Permissions;

use App\Contracts\PermissionContract;

enum ModulePermissions: string implements PermissionContract
{
    case PLATFORM = 'module:platform';
    case CLINICAL = 'module:clinical';
    case BILLING = 'module:billing';
    case INVENTORY = 'module:inventory';
    case MANAGEMENT = 'module:management';

    case RESTRICT_PLATFORM = 'module:restrict:platform';
    case RESTRICT_CLINICAL = 'module:restrict:clinical';
    case RESTRICT_BILLING = 'module:restrict:billing';
    case RESTRICT_INVENTORY = 'module:restrict:inventory';
    case RESTRICT_MANAGEMENT = 'module:restrict:management';

    public function label(): string
    {
        return match ($this) {
            self::PLATFORM => 'Access Platform Module',
            self::CLINICAL => 'Access Clinical / EHR Module',
            self::BILLING => 'Access Billing & Finance Module',
            self::INVENTORY => 'Access Pharmacy & Inventory Module',
            self::MANAGEMENT => 'Access System Management Module',

            self::RESTRICT_PLATFORM => 'Restrict Platform Module',
            self::RESTRICT_CLINICAL => 'Restrict Clinical / EHR Module',
            self::RESTRICT_BILLING => 'Restrict Billing & Finance Module',
            self::RESTRICT_INVENTORY => 'Restrict Pharmacy & Inventory Module',
            self::RESTRICT_MANAGEMENT => 'Restrict System Management Module',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::PLATFORM => 'Allows access to core platform features.',
            self::CLINICAL => 'Allows access to outpatient, inpatient, and clinical workflows.',
            self::BILLING => 'Allows access to patient billing, claims, and invoices.',
            self::INVENTORY => 'Allows access to pharmacy stocks, drug registers, and inventory.',
            self::MANAGEMENT => 'Allows access to system configurations, users, and roles.',

            self::RESTRICT_PLATFORM => 'Explicitly denies access to core platform features.',
            self::RESTRICT_CLINICAL => 'Explicitly denies access to clinical and EHR workflows.',
            self::RESTRICT_BILLING => 'Explicitly denies access to billing and financial features.',
            self::RESTRICT_INVENTORY => 'Explicitly denies access to pharmacy and inventory management.',
            self::RESTRICT_MANAGEMENT => 'Explicitly denies access to system management.',
        };
    }

    public function module(): string
    {
        return 'Module Access';
    }
}
