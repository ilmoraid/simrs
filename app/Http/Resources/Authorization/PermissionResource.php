<?php

namespace App\Http\Resources\Authorization;

use App\Http\Resources\Common\DateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

/**
 * @property string $uuid
 * @property string $name
 * @property string $label
 * @property string $module
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
final class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'label' => $this->label,
            'module' => $this->module,
            'description' => blank($this->description)
                ? 'No description'
                : $this->description,

            // Nested Date Resources
            'created_at' => DateResource::make($this->created_at),
            'updated_at' => DateResource::make($this->updated_at),
        ];
    }
}
