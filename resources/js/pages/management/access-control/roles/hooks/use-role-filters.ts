import { useMemo, useState } from 'react';
import type { Role } from '@/types/authorization/role';

export function useRoleFilters(roles: Role[] = []) {
    const [query, setQuery] = useState('');
    const [filter, setFilter] = useState<string>('all');

    const filteredRoles = useMemo(() => {
        return roles?.filter((role) => {
            const matchesQuery = role.name
                .toLowerCase()
                .includes(query.toLowerCase());

            const matchesFilter =
                filter === 'all' ||
                (filter === 'system' && role.is_system) ||
                (filter === 'custom' && !role.is_system);

            return matchesQuery && matchesFilter;
        });
    }, [roles, query, filter]);

    return {
        query,
        setQuery,
        filter,
        setFilter,
        filteredRoles,
    };
}
