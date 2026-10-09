<?php

namespace App\Http\Resources\Authorization;

use App\Http\Resources\Authentication\UserResource;
use App\Http\Resources\Common\DateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $uuid
 * @property string $name
 * @property string|null $description
 * @property bool $is_system
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\Authentication\User|null $creator
 * @property \App\Models\Authentication\User|null $updater
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Authorization\Permission>|null $permissions
 */
final class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "uuid" => $this->uuid,
            "name" => $this->name,
            "description" => $this->description,
            "is_system" => (bool) $this->is_system,

            // Nested Date Resources
            "created_at" => DateResource::make($this->created_at),
            "updated_at" => DateResource::make($this->updated_at),

            // Relations
            "users" => UserResource::collection($this->whenLoaded("users")),
            "permissions" => PermissionResource::collection(
                $this->whenLoaded("permissions"),
            ),
            "created_by_name" => $this->whenLoaded(
                "creator",
                fn() => $this->creator?->name,
                "System",
            ),
            "updated_by_name" => $this->whenLoaded(
                "updater",
                fn() => $this->updater?->name,
                "System",
            ),

            // Counted
            "total_users" => $this->whenCounted("users"),
            "total_permissions" => $this->whenCounted("permissions"),

            // Grouped
            "permissions_grouped" => $this->whenLoaded(
                "permissions",
                fn() => PermissionGroupCollection::make(
                    $this->permissions->groupBy("module"),
                ),
            ),
        ];
    }
}
