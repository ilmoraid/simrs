import { DateResource } from '../common/date-resource';

export type Permission = {
    uuid: string;
    name: string;
    label: string;
    description: string | null;
    guard_name: string;
    module: string;
    created_at?: DateResource | null;
    updated_at?: DateResource | null;
    // [key: string]: unknown; // This allows for additional properties...
};

export type GroupedPermissions = Record<string, Permission[]>;
