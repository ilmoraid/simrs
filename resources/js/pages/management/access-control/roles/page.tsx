import { Deferred, Head } from '@inertiajs/react';
import roles from '@/routes/management/access-control/roles';
import type { Role } from '@/types';
import { CreateRoleDialog } from './components/create-role/dialog';
import { useRoleFilters } from './hooks/use-role-filters';
import { RoleFilters } from './components/filter/role-filters';
import { RoleCardSkeleton } from './components/card/role-skeleton';
import { RoleCard } from './components/card/role-card';
import RoleHeader from './components/card/role-header';

type PageProps = {
    roles?: Role[];
    totalPermission?: number;
};

const pageTitle = 'Roles & Permissions';

export default function RolesPage({ roles, totalPermission }: PageProps) {
    const { query, setQuery, filter, setFilter, filteredRoles } =
        useRoleFilters(roles);

    return (
        <div className="space-y-6 p-6">
            <Head title={pageTitle} />

            <div className="mb-8 flex flex-col justify-between gap-6 md:flex-row md:items-end">
                <RoleHeader />

                {/* create role dialog */}
                <CreateRoleDialog />
            </div>

            {/* filter */}
            <RoleFilters
                query={query}
                onQueryChange={setQuery}
                filter={filter}
                onFilterChange={setFilter}
            />

            {/* Defer load roles & permissions */}
            <Deferred
                data={['roles', 'totalPermission']}
                fallback={<RoleCardSkeleton count={8} />}
            >
                <RoleGrid
                    roles={filteredRoles}
                    totalPermission={totalPermission}
                />
            </Deferred>
        </div>
    );
}

function RoleGrid({ roles = [], totalPermission }: PageProps) {
    if (roles.length === 0) {
        return (
            <div className="flex flex-col items-center justify-center py-12 text-center text-muted-foreground">
                <p className="text-sm font-medium">
                    No roles found matching your filter.
                </p>
            </div>
        );
    }

    return (
        <div className="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            {roles.map((role) => (
                <RoleCard
                    key={role.uuid}
                    role={role}
                    totalPermission={totalPermission}
                />
            ))}
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
