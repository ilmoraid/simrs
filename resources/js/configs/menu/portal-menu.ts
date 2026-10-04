import type { NavGroup } from '@/types';

import { DashboardMenu } from './platform/dashboard';
import { OutpatientMenu } from './clinical/outpatient';
import { UserMenu } from './management/user';

export const portalMenu: NavGroup[] = [
    {
        title: 'Platform',
        permission: 'module:platform',
        items: DashboardMenu,
    },
    {
        title: 'Clinical / EHR',
        permission: 'module:clinical',
        items: OutpatientMenu,
    },
    {
        title: 'Management',
        permission: 'module:management',
        items: UserMenu,
    },
];
