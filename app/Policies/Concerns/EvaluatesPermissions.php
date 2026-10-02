<?php

namespace App\Policies\Concerns;

use App\Contracts\PermissionContract;
use App\Models\Authentication\User;

trait EvaluatesPermissions
{
    /**
     * Evaluate if an action is allowed based on a grant and optional restriction.
     */
    protected function canPerform(
        User $user,
        PermissionContract $grant,
        ?PermissionContract $restrict = null,
    ): bool {
        // If a restriction exists and user has it, deny access immediately
        if ($restrict !== null && $user->hasPermissionTo($restrict->value)) {
            return false;
        }

        return $user->hasPermissionTo($grant->value);
    }
}
