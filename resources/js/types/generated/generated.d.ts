declare namespace App {
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
                    | 'Super Admin'
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
