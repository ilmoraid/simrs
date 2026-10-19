<?php

namespace App\Actions\Management\AccessControl;

use App\Actions\Concerns\HandlesSafeExecution;
use App\Actions\Concerns\HandlesTransactions;
use App\Models\Authorization\Role;

final class DeleteRoleAction
{
    use HandlesSafeExecution;
    use HandlesTransactions;

    public function execute(Role $role): bool
    {
        return $this->safeExecute(
            fn () => $this->transaction(
                fn () => tap(
                    $role,
                    fn ($r) => throw_if(
                        $r->is_system,
                        new \Exception(__('System roles cannot be deleted.')),
                    ),
                )->delete(),
            ),
            __('crud.failed_delete', ['resource' => __('resources.role')]),
        );
    }
}
