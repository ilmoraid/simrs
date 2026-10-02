import { InertiaLinkProps } from '@inertiajs/react';
import type { LucideIcon } from 'lucide-react';

export type NavItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    url?: string;
    icon?: LucideIcon | null;
    permission?: string;
    isActive?: boolean;
    items?: NavItem[];
};
