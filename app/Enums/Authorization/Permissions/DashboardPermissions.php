<?php

declare(strict_types=1);

namespace App\Enums\Authorization\Permissions;

use App\Contracts\PermissionContract;

enum DashboardPermissions: string implements PermissionContract
{
    // --- Console (SaaS Management - Central) ---
    case VIEW_CONSOLE = 'dashboard:console:view';
    case VIEW_TENANT_METRICS = 'dashboard:console:tenants'; // Monitoring clinic usage
    case VIEW_PLATFORM_REVENUE = 'dashboard:console:revenue'; // SaaS subscription income

    // --- Portal (Clinical/Hospital - Tenant) ---
    case VIEW_PORTAL = 'dashboard:portal:view'; // Main Clinic Dashboard
    case VIEW_CLINICAL_ANALYTICS = 'dashboard:portal:clinical'; // Disease trends (ICD-10)
    case VIEW_OPERATIONAL_STATS = 'dashboard:portal:operations'; // Patient flow/Waiting times
    case VIEW_CLINIC_FINANCIALS = 'dashboard:portal:financials'; // Clinic revenue/billing

    // --- The Restrict Pattern (Privacy & Compliance) ---
    case RESTRICT_FINANCIAL_DATA = 'dashboard:restrict:financials';
    case RESTRICT_PATIENT_PHI = 'dashboard:restrict:phi'; // Protected Health Information

    public function label(): string
    {
        return match ($this) {
            self::VIEW_CONSOLE => 'SaaS Console Overview',
            self::VIEW_TENANT_METRICS => 'Tenant Health & Usage',
            self::VIEW_PLATFORM_REVENUE => 'Subscription Revenue',
            self::VIEW_PORTAL => 'Clinic Dashboard',
            self::VIEW_CLINICAL_ANALYTICS => 'Clinical & Disease Analytics',
            self::VIEW_OPERATIONAL_STATS => 'Operational Statistics',
            self::VIEW_CLINIC_FINANCIALS => 'Clinic Billing Reports',
            self::RESTRICT_FINANCIAL_DATA => 'Restrict Financial Access',
            self::RESTRICT_PATIENT_PHI => 'Restrict Patient Privacy (PHI)',
        };
    }

    public function module(): string
    {
        return 'EMR Dashboard';
    }

    public function description(): string
    {
        return match ($this) {
            self::VIEW_CONSOLE => 'Access to the master management console.',
            self::VIEW_TENANT_METRICS => 'Monitor active clinics, storage usage, and uptime.',
            self::VIEW_PLATFORM_REVENUE => 'View all incoming SaaS subscription payments.',
            self::VIEW_PORTAL => 'Main overview for clinic daily operations.',
            self::VIEW_CLINICAL_ANALYTICS => 'View diagnosis trends and patient demographics.',
            self::VIEW_OPERATIONAL_STATS => 'Monitor patient queues and bed occupancy.',
            self::VIEW_CLINIC_FINANCIALS => 'View daily clinic transactions and insurance claims.',
            self::RESTRICT_FINANCIAL_DATA => 'Strictly hides all revenue and billing widgets.',
            self::RESTRICT_PATIENT_PHI => 'Hides sensitive patient identities in dashboard summaries.',
        };
    }
}
