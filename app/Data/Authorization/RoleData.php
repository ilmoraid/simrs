<?php

namespace App\Data\Authorization;

use App\Models\Authorization\Permission;
use App\Models\Authorization\Role;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
final class RoleData extends Data
{
    /**
     * @param  array<int, string>|null  $permissions
     */
    public function __construct(
        public ?string $uuid,
        public string $name,
        public ?string $description,
        public ?string $guard_name,
        public ?array $permissions = [],
    ) {}

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Role::class, 'name'),
            ],
            'description' => ['nullable', 'string', 'max:255'],
            'guard_name' => ['nullable', 'string', 'max:25'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => [
                'required',
                Rule::exists(Permission::class, 'uuid'),
            ],
        ];
    }
}
