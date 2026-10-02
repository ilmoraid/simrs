<?php

declare(strict_types=1);

namespace App\Enums\Authorization\Roles;

enum UserRoles: string
{
    case SUPER_ADMIN = "Super Admin";
    case ADMIN = "Admin";
    case DOCTOR = "Doctor";
    case PHARMACIST = "Pharmacist";
    case REGISTRATION_STAFF = "Registration Staff";
    case BILLING_STAFF = "Billing Staff";
    case AUDITOR = "Auditor";

    /**
     * Get the display description for the role.
     */
    public function description(): string
    {
        return match ($this) {
            self::SUPER_ADMIN
                => "Highest level access. Complete control over all system features, user management, and platform configuration.",
            self::ADMIN
                => "Full access to all features and settings. Manage users, permissions, and system configuration.",
            self::DOCTOR
                => "Manages patient diagnoses, treatments, prescriptions, and medical records.",
            self::PHARMACIST
                => "Handles medication dispensing, prescription fulfillment, and drug inventory management.",
            self::REGISTRATION_STAFF
                => "Manages patient registration, demographic data, and appointment scheduling.",
            self::BILLING_STAFF
                => "Processes billing, invoices, insurance claims, and payment records.",
            self::AUDITOR
                => "Read-only access for audits, compliance reviews, and report verification.",
        };
    }

    /**
     * Determine if the role is a protected system role.
     */
    public function isSystem(): bool
    {
        return match ($this) {
            self::SUPER_ADMIN, self::ADMIN => true,
            default => false,
        };
    }
}
