<?php

namespace App\Http\Controllers\Management\AccessControl;

use App\Http\Controllers\Controller;
use App\Queries\Management\AccessControl\PermissionIndexQuery;
use App\Queries\Management\AccessControl\RoleIndexQuery;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(
        RoleIndexQuery $role,
        PermissionIndexQuery $permission,
    ): Response {
        $roles = Inertia::defer(fn() => $role->execute());
        $totalPermission = Inertia::defer(fn() => $permission->execute());

        return Inertia::render(
            "management/access-control/roles/page",
            compact("roles", "totalPermission"),
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }
}
