import profile from '@/routes/profile';
import { NavItem } from '@/types';
import { BookOpen, ShieldCheck, Users } from 'lucide-react';

export const coreSettingsMenu: NavItem = {
    title: 'Management',
    icon: BookOpen,
    href: '/login',
    items: [
        {
            title: 'Users',
            icon: Users,
            href: profile.edit(),
            permission: 'user:view',
        },
        {
            title: 'Roles & Permissions',
            icon: ShieldCheck,
            href: '/roles',
            permission: 'role:view',
        },
    ],
};
