<?php

namespace App\Models\Authorization;

use App\Concerns\HasUuids;
use Database\Factories\Authorization\RoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @property bool $is_system
 * @property string $name
 */
class Role extends SpatieRole
{
    /** @use HasFactory<RoleFactory> */
    use HasFactory;

    use HasUuids;

    protected function casts(): array
    {
        return [
            'is_system' => 'boolean',
        ];
    }
}
