declare namespace App {
    namespace Data {
        namespace Authentication {
            export type UserData = {
                uuid: string;
                name: string;
                email: string;
                avatar: string | null;
                email_verified_at: undefined | null;
                two_factor_confirmed_at: undefined | null;
                created_at: undefined | null;
                updated_at: undefined | null;
                readonly roles: App.Data.Authorization.RoleData[] | null;
                readonly permissions:
                    | App.Data.Authorization.PermissionData[]
                    | null;
            };
        }
        namespace Authorization {
            export type PermissionData = {
                uuid: string;
                name: string;
                label: string;
                module: string;
                description: string | null;
                created_at: undefined | null;
                updated_at: undefined | null;
            };
            export type RoleData = {
                uuid: string;
                name: string;
                description: string | null;
                is_system: boolean;
                created_at: undefined | null;
                updated_at: undefined | null;
                readonly users: App.Data.Authentication.UserData[];
                readonly permissions: App.Data.Authorization.PermissionData[];
                created_by_name: undefined | string | null;
                updated_by_name: undefined | string | null;
                total_users: undefined | number | null;
                total_permissions: undefined | number | null;
                permissions_grouped: Record<string, any>;
            };
        }
    }
    namespace Enums {
        namespace Authorization {
            namespace Permissions {
                export type DashboardPermissions =
                    | 'dashboard:console:view'
                    | 'dashboard:console:tenants'
                    | 'dashboard:console:revenue'
                    | 'dashboard:portal:view'
                    | 'dashboard:portal:clinical'
                    | 'dashboard:portal:operations'
                    | 'dashboard:portal:financials'
                    | 'dashboard:restrict:financials'
                    | 'dashboard:restrict:phi';
                export type GeneralPermissions =
                    | 'general:access'
                    | 'general:console:manage'
                    | 'general:console:plans'
                    | 'general:console:logs'
                    | 'general:portal:settings'
                    | 'general:portal:units'
                    | 'general:portal:hours'
                    | 'general:restrict:settings'
                    | 'general:restrict:logs';
                export type ModulePermissions =
                    | 'module:platform'
                    | 'module:clinical'
                    | 'module:billing'
                    | 'module:inventory'
                    | 'module:management'
                    | 'module:restrict:platform'
                    | 'module:restrict:clinical'
                    | 'module:restrict:billing'
                    | 'module:restrict:inventory'
                    | 'module:restrict:management';
                export type RolePermissions =
                    | 'role:view'
                    | 'role:create'
                    | 'role:update'
                    | 'role:delete'
                    | 'role:restrict:view'
                    | 'role:restrict:create'
                    | 'role:restrict:update'
                    | 'role:restrict:delete';
                export type UserPermissions =
                    | 'user:view'
                    | 'user:update'
                    | 'user:delete'
                    | 'user:restrict:view'
                    | 'user:restrict:update'
                    | 'user:restrict:delete';
            }
            namespace Roles {
                export type UserRoles =
                    | 'Administrator'
                    | 'Admin'
                    | 'Doctor'
                    | 'Pharmacist'
                    | 'Registration Staff'
                    | 'Billing Staff'
                    | 'Auditor';
            }
        }
    }
}
