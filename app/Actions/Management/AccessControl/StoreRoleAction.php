<?php

namespace App\Actions\Management\AccessControl;

use App\Actions\Concerns\HandlesSafeExecution;
use App\Actions\Concerns\HandlesTransactions;
use App\Data\Management\AccessControl\Role\StoreRoleData;
use App\Models\Authorization\Role;

final class StoreRoleAction
{
    use HandlesSafeExecution;
    use HandlesTransactions;

    public function execute(StoreRoleData $data): Role
    {
        return $this->safeExecute(
            fn () => $this->transaction(fn () => Role::create($data->toArray())),
            __('crud.failed_create', ['resource' => __('resources.role')]),
        );
    }
}
