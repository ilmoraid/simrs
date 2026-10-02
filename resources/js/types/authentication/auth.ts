import { User } from './user';

export type Auth = {
    user: User;
    roles: string[];
    permissions: string[];
    is_console: boolean;
};
