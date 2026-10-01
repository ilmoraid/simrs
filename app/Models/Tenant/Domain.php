<?php

declare(strict_types=1);

namespace App\Models\Tenant;

use Database\Factories\Tenant\DomainFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Models\Domain as BaseDomain;

class Domain extends BaseDomain
{
    /** @use HasFactory<DomainFactory> */
    use HasFactory;
}
