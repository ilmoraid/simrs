import { portalMenu } from './portal-menu';
import { footerNavItems } from './footer-menu';
import { NavGroup, NavItem } from '@/types';

export interface MenuRegistry {
    navMain: NavGroup[];
    navFooter: NavItem[];
}

export const getMenus = (isConsole: boolean = false): MenuRegistry => ({
    navMain: isConsole ? [] : portalMenu,
    navFooter: footerNavItems,
});
