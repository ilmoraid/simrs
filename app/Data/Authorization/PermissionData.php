<?php

namespace App\Data\Authorization;

use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
final class PermissionData extends Data
{
    public function __construct(
        #[Nullable, StringType] public ?string $uuid,

        #[Required, StringType, Max(225)] public string $name,

        #[Required, StringType, Max(25)] public string $guard_name,

        #[Nullable, StringType, Max(225)] public ?string $label,

        #[Nullable, StringType] public ?string $description,

        #[Required, StringType, Max(255)] public string $module,
    ) {}
}
