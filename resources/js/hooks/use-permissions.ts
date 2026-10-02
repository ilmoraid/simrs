import { useMemo } from 'react';
import { usePage } from '@inertiajs/react';

/**
 * Custom React Hook to check user permissions and roles.
 * Mirroring Laravel Spatie: @can -> can(), @hasrole -> hasRole()
 */
export const usePermissions = () => {
    const { props } = usePage();

    // Memoize Set data structures for O(1) instant lookups
    const userPermissions = useMemo(() => {
        return new Set<string>(props.auth?.permissions ?? []);
    }, [props.auth?.permissions]);

    const userRoles = useMemo(() => {
        return new Set<string>(props.auth?.roles ?? []);
    }, [props.auth?.roles]);

    /**
     * Check for a single permission.
     */
    const can = (permissionName: string): boolean => {
        return userPermissions.has(permissionName);
    };

    /**
     * Check if user has ANY of the provided permissions.
     */
    const canAny = (permissionNames: string[]): boolean => {
        return permissionNames.some((permission) =>
            userPermissions.has(permission),
        );
    };

    /**
     * Check if user has ALL of the provided permissions.
     */
    const canAll = (permissionNames: string[]): boolean => {
        return permissionNames.every((permission) =>
            userPermissions.has(permission),
        );
    };

    /**
     * Check for a specific role.
     */
    const hasRole = (roleName: string): boolean => {
        return userRoles.has(roleName);
    };

    /**
     * Check if user has ANY of the provided roles.
     */
    const hasAnyRole = (roleNames: string[]): boolean => {
        return roleNames.some((role) => userRoles.has(role));
    };

    /**
     * Check if user has ALL of the provided roles.
     */
    const hasAllRoles = (roleNames: string[]): boolean => {
        return roleNames.every((role) => userRoles.has(role));
    };

    return {
        can,
        canAny,
        canAll,
        hasRole,
        hasAnyRole,
        hasAllRoles,
        permissions: props.auth?.permissions ?? [],
        roles: props.auth?.roles ?? [],
    };
};
