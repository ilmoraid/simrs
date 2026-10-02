<?php

declare(strict_types=1);

namespace App\Enums\Authorization\Permissions;

use App\Contracts\PermissionContract;

enum RolePermissions: string implements PermissionContract
{
    case VIEW = "role:view";
    case CREATE = "role:create";
    case UPDATE = "role:update";
    case DELETE = "role:delete";

    case RESTRICT_VIEW = "role:restrict:view";
    case RESTRICT_CREATE = "role:restrict:create";
    case RESTRICT_UPDATE = "role:restrict:update";
    case RESTRICT_DELETE = "role:restrict:delete";

    public function label(): string
    {
        return match ($this) {
            self::VIEW => "View Roles",
            self::CREATE => "Create Roles",
            self::UPDATE => "Update Roles",
            self::DELETE => "Delete Roles",
            self::RESTRICT_VIEW => "Restrict Viewing Roles",
            self::RESTRICT_CREATE => "Restrict Creating Roles",
            self::RESTRICT_UPDATE => "Restrict Updating Roles",
            self::RESTRICT_DELETE => "Restrict Deleting Roles",
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::VIEW => "Allows viewing the role list.",
            self::CREATE => "Allows creating role permissions.",
            self::UPDATE => "Allows editing role permissions.",
            self::DELETE => "Allows removing roles from the system.",
            self::RESTRICT_VIEW => "Explicitly denies viewing roles.",
            self::RESTRICT_CREATE => "Explicitly denies creating roles.",
            self::RESTRICT_UPDATE => "Explicitly denies updating roles.",
            self::RESTRICT_DELETE => "Explicitly denies deleting roles.",
        };
    }

    public function module(): string
    {
        return "Role Management";
    }
}
