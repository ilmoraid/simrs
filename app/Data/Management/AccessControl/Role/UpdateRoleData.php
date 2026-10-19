<?php

namespace App\Data\Management\AccessControl\Role;

use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

final class UpdateRoleData extends Data
{
    /**
     * Create a new UpdateRoleData instance for the update process.
     *
     * @param  string|null  $name  New role name (optional during update).
     * @param  string|null  $description  New description.
     * @param  string|null  $guard_name  Optional guard_name for the role.
     */
    public function __construct(
        public ?string $name,
        public ?string $description,
        public ?string $guard_name = 'web',
    ) {}

    /**
     * Detailed validation rules for update operation.
     *
     * @return array<string, mixed>
     */
    public static function rules(): array
    {
        // Retrieve the role model currently being edited from the route parameters (e.g., /roles/{role})
        $role = request()->route('role');

        return [
            // Use 'sometimes' so fields are optional during update,
            // and ignore($role) so its own name is not considered a duplicate during update.
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:50',
                Rule::unique('roles', 'name')->ignore($role),
            ],
            'description' => ['sometimes', 'nullable', 'string', 'max:255'],
            'guard_name' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
