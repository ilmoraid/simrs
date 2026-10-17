<?php

namespace App\Actions\Management\AccessControl;

use App\Actions\Concerns\HandlesSafeExecution;
use App\Actions\Concerns\HandlesTransactions;
use App\Data\Authorization\RoleData;
use App\Models\Authorization\Role;

final class DeleteRoleAction
{
    use HandlesSafeExecution;
    use HandlesTransactions;

    public function execute(Role $role): bool
    {
        $roleData = RoleData::from($role);

        return $this->safeExecute(
            fn () => $this->transaction(
                fn () => ! $roleData->is_system && $role->delete(),
            ),
            __('crud.failed_delete', ['resource' => __('resources.role')]),
        );
    }
}
