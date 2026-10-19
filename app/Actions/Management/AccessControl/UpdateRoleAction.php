<?php

namespace App\Actions\Management\AccessControl;

use App\Actions\Concerns\HandlesSafeExecution;
use App\Actions\Concerns\HandlesTransactions;
use App\Data\Management\AccessControl\Role\UpdateRoleData;
use App\Models\Authorization\Role;

final class UpdateRoleAction
{
    use HandlesSafeExecution;
    use HandlesTransactions;

    public function execute(UpdateRoleData $data, Role $role): bool
    {
        return $this->safeExecute(
            fn () => $this->transaction(fn () => $role->update($data->toArray())),
            __('crud.failed_update', ['resource' => __('resources.role')]),
        );
    }
}
