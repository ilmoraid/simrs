import { useEffect } from 'react';
import { usePage } from '@inertiajs/react';
import { useToast } from '@/hooks/use-toast';

export function useToastListener() {
    const { toast: flash } = usePage().flash;
    const toast = useToast();

    useEffect(() => {
        if (!flash) return;

        if (flash.type === 'success') {
            toast.success(flash.message);
        }

        if (flash.type === 'error') {
            toast.error(flash.message);
        }

        if (flash.type === 'info') {
            toast.info(flash.message);
        }

        if (flash.type === 'warning') {
            toast.warning(flash.message);
        }
    }, [flash]);
}
