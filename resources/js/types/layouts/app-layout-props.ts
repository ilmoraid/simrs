import type { ReactNode } from 'react';
import { BreadcrumbItem } from './breadcrumb-item';

export type AppLayoutProps = {
    children: ReactNode;
    breadcrumbs?: BreadcrumbItem[];
};
