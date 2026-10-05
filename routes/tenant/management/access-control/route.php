<?php

use Illuminate\Support\Facades\Route;

Route::prefix('access-control')
    ->name('access-control.')
    ->group(function () {
        /** roles */
        require_once __DIR__.'/roles.php';
    });
