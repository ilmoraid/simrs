<?php

use Illuminate\Support\Facades\Route;

Route::prefix('management')
    ->name('management.')
    ->group(function () {
        /** Access Control */
        require_once __DIR__.'/access-control/route.php';
    });
