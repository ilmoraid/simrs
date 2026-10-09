import { User } from '../authentication';
import { DateResource } from '../common/date-resource';
import { GroupedPermissions, Permission } from './permission';

export type Role = {
    uuid: string;
    name: string;
    description: string | null;
    is_system: boolean;
    created_at: DateResource | null;
    updated_at: DateResource | null;

    /** * Relations
     * We use Permission[] for the raw flat list
     */
    users?: User[] | [];
    permissions?: Permission[] | [];
    created_by_name?: string | null;
    updated_by_name?: string | null;

    /** Counted
     * total_permissions for total count of permission that role have
     */
    total_users?: number | null;
    total_permissions?: number | null;

    /** Grouped
     * permissions_grouped for grouped permission
     */
    permissions_grouped?: GroupedPermissions;
};
