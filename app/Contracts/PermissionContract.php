<?php

declare(strict_types=1);

namespace App\Contracts;

use BackedEnum;

/**
 * @property-read string $value
 */
interface PermissionContract extends BackedEnum
{
    /**
     * Get the human-readable display label for the permission.
     */
    public function label(): string;

    /**
     * Get the module or feature category name the permission belongs to.
     */
    public function module(): string;

    /**
     * Get the detailed description explaining what the permission allows or restricts.
     */
    public function description(): string;
}
