import { NavItem } from './nav-item';

export interface NavGroup {
    title?: string;
    permission?: string | string[];
    items: NavItem[];
}
