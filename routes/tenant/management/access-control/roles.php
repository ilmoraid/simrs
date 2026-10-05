<?php

use App\Http\Controllers\Management\AccessControl\RoleController;
use Illuminate\Support\Facades\Route;

Route::resource('roles', RoleController::class)->only('index');
