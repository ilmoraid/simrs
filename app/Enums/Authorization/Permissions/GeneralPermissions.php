<?php

declare(strict_types=1);

namespace App\Enums\Authorization\Permissions;

use App\Contracts\PermissionContract;

enum GeneralPermissions: string implements PermissionContract
{
    // --- Global ---
    case GENERAL = 'general:access';

    // --- Console (Central/SaaS Settings) ---
    case MANAGE_PLATFORM = 'general:console:manage'; // Global settings
    case MANAGE_PLANS = 'general:console:plans'; // Subscription plans
    case VIEW_LOGS = 'general:console:logs'; // System-wide error logs

    // --- Portal (Clinic/Tenant Settings) ---
    case MANAGE_CLINIC = 'general:portal:settings'; // Clinic name, address, logo
    case MANAGE_DEPARTMENTS = 'general:portal:units'; // Polyclinics (Radiology, Dental, etc.)
    case MANAGE_SCHEDULES = 'general:portal:hours'; // Opening/Closing hours

    // --- Restrictions ---
    case RESTRICT_SETTINGS = 'general:restrict:settings';
    case RESTRICT_LOGS = 'general:restrict:logs';

    public function label(): string
    {
        return match ($this) {
            self::GENERAL => 'General Access',
            self::MANAGE_PLATFORM => 'Platform Configuration',
            self::MANAGE_PLANS => 'Subscription Plan Management',
            self::VIEW_LOGS => 'System Audit Logs',
            self::MANAGE_CLINIC => 'Clinic Profile Settings',
            self::MANAGE_DEPARTMENTS => 'Department/Unit Management',
            self::MANAGE_SCHEDULES => 'Operating Hours Management',
            self::RESTRICT_SETTINGS => 'Restrict Settings Access',
            self::RESTRICT_LOGS => 'Restrict Log Visibility',
        };
    }

    public function module(): string
    {
        return 'System & Settings';
    }

    public function description(): string
    {
        return match ($this) {
            self::GENERAL => 'Basic access to the system.',
            self::MANAGE_PLATFORM => 'Modify global SaaS configurations and SEO.',
            self::MANAGE_PLANS => 'Create and edit subscription tiers for clinics.',
            self::VIEW_LOGS => 'View technical error logs and system activity.',
            self::MANAGE_CLINIC => 'Update clinic contact info and branding.',
            self::MANAGE_DEPARTMENTS => 'Configure polyclinics and service units.',
            self::MANAGE_SCHEDULES => 'Set the active working hours for the facility.',
            self::RESTRICT_SETTINGS => 'Explicitly blocks access to configuration panels.',
            self::RESTRICT_LOGS => 'Explicitly blocks access to technical logs.',
        };
    }
}
