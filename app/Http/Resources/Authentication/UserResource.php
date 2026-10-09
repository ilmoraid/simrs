<?php

namespace App\Http\Resources\Authentication;

use App\Http\Resources\Authorization\RoleResource;
use App\Http\Resources\Common\DateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $uuid
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property \Illuminate\Support\Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $avatar
 */
final class UserResource extends JsonResource
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
            "email" => $this->email,
            "avatar" => $this->avatar,

            // Nested Date Resources
            "email_verified_at" => DateResource::make($this->email_verified_at),
            "two_factor_confirmed_at" => DateResource::make(
                $this->two_factor_confirmed_at,
            ),
            "created_at" => DateResource::make($this->created_at),
            "updated_at" => DateResource::make($this->updated_at),

            // relations
            "roles" => RoleResource::collection($this->whenLoaded("roles")),
            "permissions" => RoleResource::collection(
                $this->whenLoaded("permissions"),
            ),
        ];
    }
}
