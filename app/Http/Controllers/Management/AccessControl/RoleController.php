<?php

namespace App\Http\Controllers\Management\AccessControl;

use App\Actions\Management\AccessControl\StoreRoleAction;
use App\Data\Authorization\RoleData;
use App\Http\Controllers\Controller;
use App\Queries\Management\AccessControl\PermissionIndexQuery;
use App\Queries\Management\AccessControl\RoleIndexQuery;
use App\Support\Toast;
use Illuminate\Http\RedirectResponse;
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
        $roles = Inertia::defer(fn () => $role->execute());
        $totalPermission = Inertia::defer(fn () => $permission->execute());

        return Inertia::render(
            'management/access-control/roles/page',
            compact('roles', 'totalPermission'),
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
    public function store(
        RoleData $data,
        StoreRoleAction $action,
    ): RedirectResponse {
        $action->execute($data);

        Toast::success(
            __('crud.created', ['resource' => __('resources.role')]),
        );

        return to_route('management.access-control.roles.index');
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
