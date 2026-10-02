import { NavGroup } from '@/types';

import { DashboardMenu } from './platform/dashboard';
import { OutpatientMenu } from './clinical/outpatient';
import { UserMenu } from './management/user';

export const portalMenu: NavGroup[] = [
    {
        title: 'Platform',
        permission: 'general:access',
        items: DashboardMenu,
    },
    {
        title: 'Clinical / EHR',
        items: OutpatientMenu,
    },
    {
        title: 'Management',
        items: UserMenu,
    },
];
