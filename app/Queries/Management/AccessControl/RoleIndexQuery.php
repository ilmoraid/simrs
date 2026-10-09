<?php

namespace App\Queries\Management\AccessControl;

use App\Http\Resources\Authorization\RoleResource;
use App\Models\Authorization\Role;
use Illuminate\Database\Eloquent\Relations\Relation;

final class RoleIndexQuery
{
    /**
     * Execute the query.
     *
     * @return array<int, array<string, mixed>>
     */
    public function execute(): array
    {
        $roles = Role::query()
            ->with([
                "users" => fn(Relation $query) => $query->limit(3),
            ])
            ->withCount(["users", "permissions"])
            ->get();

        return RoleResource::collection($roles)->resolve();
    }
}
