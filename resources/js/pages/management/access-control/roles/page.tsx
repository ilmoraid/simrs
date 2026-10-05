import { Deferred, Head } from '@inertiajs/react';
import { Skeleton } from '@/components/ui/skeleton';
import roles from '@/routes/management/access-control/roles';
import type { Permission, Role } from '@/types';

type PageProps = {
    roles?: Role[];
    availablePermissions?: Record<string, Permission[]>;
};

const pageTitle = 'Roles & Permissions';

export default function RolesPage({ roles, availablePermissions }: PageProps) {
    return (
        <div className="space-y-6 p-6">
            <Head title={pageTitle} />

            <div className="flex items-center justify-between">
                <div>
                    <h1 className="text-2xl font-bold tracking-tight">
                        {pageTitle}
                    </h1>
                    <p className="text-sm text-muted-foreground">
                        Manage system roles and assign domain permissions.
                    </p>
                </div>
            </div>

            {/* Defer load roles & permissions */}
            <Deferred
                data={['roles', 'availablePermissions']}
                fallback={<RolesSkeleton />}
            >
                <RolesTable
                    roles={roles}
                    availablePermissions={availablePermissions}
                />
            </Deferred>
        </div>
    );
}

function RolesTable({ roles }: PageProps) {
    return (
        <div className="rounded-md border p-4">
            <div className="grid gap-4">
                {roles?.map((role) => (
                    <div
                        key={role.uuid}
                        className="flex items-center justify-between border-b pb-2"
                    >
                        <div>
                            <p className="font-semibold">{role.name}</p>
                            <p className="text-xs text-muted-foreground">
                                {role.permissions?.length ?? 0} permissions
                                assigned
                            </p>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
}

function RolesSkeleton() {
    return (
        <div className="space-y-3 rounded-md border p-4">
            <Skeleton className="h-6 w-1/4" />
            <Skeleton className="h-12 w-full" />
            <Skeleton className="h-12 w-full" />
            <Skeleton className="h-12 w-full" />
        </div>
    );
}

RolesPage.layout = {
    breadcrumbs: [
        {
            title: pageTitle,
            href: roles.index(),
        },
    ],
};
