<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    "web",
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::fortifyTenant();

    Route::redirect("/", "/dashboard");

    Route::middleware(["auth", "verified"])->group(function () {
        Route::inertia("dashboard", "dashboard")->name("dashboard");

        /** management */
        require_once __DIR__ . "/management/route.php";

        require_once __DIR__ . "/settings/route.php";
    });
});
