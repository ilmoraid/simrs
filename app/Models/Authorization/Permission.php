<?php

namespace App\Models\Authorization;

use App\Concerns\HasUuids;
use Database\Factories\Authorization\PermissionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    /** @use HasFactory<PermissionFactory> */
    use HasFactory;

    use HasUuids;
}
