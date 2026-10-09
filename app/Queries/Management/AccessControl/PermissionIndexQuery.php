<?php

namespace App\Queries\Management\AccessControl;

use App\Models\Authorization\Permission;

final class PermissionIndexQuery
{
    /**
     * Execute the query.
     */
    public function execute(): int
    {
        return Permission::query()->count();
    }
}
