import { LucideIcon } from 'lucide-react';
import { AppPermission } from '../generated/authorization';
import { InertiaLinkProps } from '@inertiajs/react';

export type NavItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    url?: string;
    icon?: LucideIcon | null;
    permission?: AppPermission | AppPermission[] | null;
    isActive?: boolean;
    items?: NavItem[];
};
