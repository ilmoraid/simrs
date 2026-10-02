import { NavItem } from '@/types';
import { Stethoscope } from 'lucide-react';

export const OutpatientMenu: NavItem[] = [
    {
        title: 'Outpatient (RJ)',
        href: '/rawat-jalan',
        icon: Stethoscope,
        permission: 'outpatient:view',
    },
];
