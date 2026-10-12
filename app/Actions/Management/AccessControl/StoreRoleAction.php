<?php

namespace App\Actions\Management\AccessControl;

use App\Actions\Concerns\HandlesSafeExecution;
use App\Actions\Concerns\HandlesTransactions;
use App\Data\Authorization\RoleData;
use App\Models\Authorization\Role;

final class StoreRoleAction
{
    use HandlesSafeExecution;
    use HandlesTransactions;

    public function execute(RoleData $data): Role
    {
        return $this->safeExecute(
            fn () => $this->transaction(
                fn () => Role::create([
                    'name' => $data->name,
                    'description' => $data->description,
                    'guard_name' => $data->guard_name,
                ]),
            ),
            __('crud.failed_create', ['resource' => __('resources.role')]),
        );
    }
}
