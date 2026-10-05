<?php

namespace App\Http\Controllers\Management\AccessControl;

use App\Http\Controllers\Controller;
use App\Models\Authorization\Permission;
use App\Models\Authorization\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $roles = Inertia::defer(
            fn () => Role::query()
                ->with(['permissions:uuid,label'])
                ->get(),
        );
        $permissions = Inertia::defer(fn () => Permission::query()->get());

        return Inertia::render('management/access-control/roles/page', [
            'roles' => $roles,
            'availablePermissions' => $permissions,
        ]);
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
