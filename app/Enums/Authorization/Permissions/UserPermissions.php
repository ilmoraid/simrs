<?php

declare(strict_types=1);

namespace App\Enums\Authorization\Permissions;

use App\Contracts\PermissionContract;

enum UserPermissions: string implements PermissionContract
{
    case VIEW = 'user:view';
    case UPDATE = 'user:update';
    case DELETE = 'user:delete';

    case RESTRICT_VIEW = 'user:restrict:view';
    case RESTRICT_UPDATE = 'user:restrict:update';
    case RESTRICT_DELETE = 'user:restrict:delete';

    public function label(): string
    {
        return match ($this) {
            self::VIEW => 'View Users',
            self::UPDATE => 'Update User Details',
            self::DELETE => 'Delete Users',
            self::RESTRICT_VIEW => 'Restrict Viewing Users',
            self::RESTRICT_UPDATE => 'Restrict Updating Users',
            self::RESTRICT_DELETE => 'Restrict Deleting Users',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::VIEW => 'Allows viewing the user management list.',
            self::UPDATE => 'Allows editing user profiles and roles.',
            self::DELETE => 'Allows permanent removal of user accounts.',
            self::RESTRICT_VIEW => 'Explicitly denies viewing users.',
            self::RESTRICT_UPDATE => 'Explicitly denies updating users.',
            self::RESTRICT_DELETE => 'Explicitly denies deleting users.',
        };
    }

    public function module(): string
    {
        return 'User Management';
    }
}
