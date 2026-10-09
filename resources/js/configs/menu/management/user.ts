import roles from '@/routes/management/access-control/roles';
import type { NavItem } from '@/types';
import { Shield, ShieldCheck, Users } from 'lucide-react';

export const UserMenu: NavItem[] = [
    {
        title: 'Access Control',
        href: '/users',
        icon: Shield,
        items: [
            {
                title: 'Users & Accounts',
                href: '/user',
                icon: Users,
                permission: 'user:view',
            },
            {
                title: 'Roles & Permissions',
                href: roles.index(),
                icon: ShieldCheck,
                permission: 'role:view',
            },
        ],
    },
];
