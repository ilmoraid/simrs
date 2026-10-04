import { ComponentType } from 'react';
import { NavItem } from './nav-item';
import { LucideProps } from 'lucide-react';
import { AppPermission } from '../generated/authorization';
import { InertiaLinkProps } from '@inertiajs/react';

export type NavGroup = {
    title: string;
    href?: NonNullable<InertiaLinkProps['href']>;
    url?: string;
    icon?: ComponentType<LucideProps>;
    permission?: AppPermission | AppPermission[];
    items: NavItem[];
};
