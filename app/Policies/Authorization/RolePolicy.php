<?php

declare(strict_types=1);

namespace App\Policies\Authorization;

use App\Enums\Authorization\Permissions\RolePermissions;
use App\Models\Authentication\User;
use App\Policies\Concerns\EvaluatesPermissions;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    use EvaluatesPermissions;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->canPerform(
            $user,
            RolePermissions::VIEW,
            RolePermissions::RESTRICT_VIEW,
        );
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        return $this->canPerform(
            $user,
            RolePermissions::VIEW,
            RolePermissions::RESTRICT_VIEW,
        );
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->canPerform(
            $user,
            RolePermissions::UPDATE,
            RolePermissions::RESTRICT_UPDATE,
        );
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        return $this->canPerform(
            $user,
            RolePermissions::UPDATE,
            RolePermissions::RESTRICT_UPDATE,
        );
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        return $this->canPerform(
            $user,
            RolePermissions::DELETE,
            RolePermissions::RESTRICT_DELETE,
        );
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        return $this->canPerform(
            $user,
            RolePermissions::UPDATE,
            RolePermissions::RESTRICT_UPDATE,
        );
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        return $this->canPerform(
            $user,
            RolePermissions::DELETE,
            RolePermissions::RESTRICT_DELETE,
        );
    }
}
