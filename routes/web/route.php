<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::domain(config('tenancy.central_domains')[0])->group(function () {
    // your actual routes
});
