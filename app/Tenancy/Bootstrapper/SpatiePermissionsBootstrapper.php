<?php

namespace App\Tenancy\Bootstrapper;

use Spatie\Permission\PermissionRegistrar;
use Stancl\Tenancy\Contracts\TenancyBootstrapper;
use Stancl\Tenancy\Contracts\Tenant;

class SpatiePermissionsBootstrapper implements TenancyBootstrapper
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected PermissionRegistrar $registrar) {}

    public function bootstrap(Tenant $tenant): void
    {
        $this->registrar->cacheKey =
            'spatie.permission.cache.tenant.'.$tenant->getTenantKey();
    }

    public function revert(): void
    {
        $this->registrar->cacheKey = 'spatie.permission.cache';
    }
}
