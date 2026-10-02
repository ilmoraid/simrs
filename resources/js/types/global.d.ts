import { Auth } from './authentication/auth';
import { FlashMessages } from './common/flash-messages';

declare module 'react' {
    interface InputHTMLAttributes<T> {
        passwordrules?: string;
    }
}

declare module '@inertiajs/core' {
    export interface InertiaConfig {
        sharedPageProps: {
            name: string;
            auth: Auth;
            sidebarOpen: boolean;
            flash?: FlashMessages;
            [key: string]: unknown;
        };
    }
}
