<?php

namespace App\Data\Management\AccessControl\Role;

use App\Models\Authorization\Role;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

final class StoreRoleData extends Data
{
    /**
     * Create a new StoreRoleData instance for the creation process.
     *
     * @param  string  $name  The name of the role.
     * @param  string|null  $description  Optional description for the role.
     * @param  string|null  $guard_name  Optional guard_name for the role.
     */
    public function __construct(
        public string $name,
        public ?string $description,
        public ?string $guard_name = 'web',
    ) {}

    /**
     * Detailed validation rules for store operation.
     *
     * @return array<string, mixed>
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
            'guard_name' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
