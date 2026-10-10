import { useMemo, useState } from 'react';
import { useDebounce } from '@/hooks/use-debounce';
import type { Role } from '@/types';

export type RoleFilter = 'all' | 'system' | 'custom';

export function useRoleFilters(roles: Role[] = []) {
    const [query, setQuery] = useState('');
    const [filter, setFilter] = useState<RoleFilter>('all');

    // Debounce query with a 300ms delay
    const debouncedQuery = useDebounce(query, 300);

    const filteredRoles = useMemo(() => {
        const normalizedQuery = debouncedQuery.trim().toLowerCase();

        return roles.filter((role) => {
            const matchesQuery =
                !normalizedQuery ||
                (role.name?.toLowerCase().includes(normalizedQuery) ?? false);

            const matchesFilter =
                filter === 'all' ||
                (filter === 'system' && role.is_system) ||
                (filter === 'custom' && !role.is_system);

            return matchesQuery && matchesFilter;
        });
    }, [roles, debouncedQuery, filter]);

    return {
        query,
        setQuery,
        filter,
        setFilter,
        filteredRoles,
    };
}
