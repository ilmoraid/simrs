import profile from '@/routes/profile';
import { NavItem } from '@/types';
import { Settings, ShieldCheck, Users } from 'lucide-react';

export const UserMenu: NavItem[] = [
    {
        title: 'Settings',
        href: '/users',
        icon: Settings,
        items: [
            {
                title: 'Users',
                href: profile.edit(),
                icon: Users,
                permission: 'user:view',
            },
            {
                title: 'Roles & Permissions',
                href: '/roles',
                icon: ShieldCheck,
                permission: 'role:view',
            },
        ],
    },
];
