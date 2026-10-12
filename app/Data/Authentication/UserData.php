<?php

namespace App\Data\Authentication;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
final class UserData extends Data
{
    public function __construct(
        #[Nullable, StringType] public ?string $uuid,

        #[Required, StringType, Max(255)] public string $name,

        #[Required, Email, Max(255)] public string $email,

        #[Nullable, StringType, Max(255)] public ?string $avatar,
    ) {}
}
