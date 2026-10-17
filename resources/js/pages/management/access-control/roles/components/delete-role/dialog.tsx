import { Trash2Icon } from 'lucide-react';

import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogMedia,
    AlertDialogTitle,
} from '@/components/ui/alert-dialog';
import { Form } from '@inertiajs/react';
import roles from '@/routes/management/access-control/roles';
import { Role } from '@/types';
import { Spinner } from '@/components/ui/spinner';

type DeleteProps = {
    open: boolean;
    role: Role;
    onOpenChange: (open: boolean) => void;
};

export function DeleteRoleAlertDialog({
    role,
    open,
    onOpenChange,
}: DeleteProps) {
    return (
        <AlertDialog open={open} onOpenChange={onOpenChange}>
            <AlertDialogContent size="sm">
                <AlertDialogHeader>
                    <AlertDialogMedia className="bg-destructive/10 text-destructive dark:bg-destructive/20">
                        <Trash2Icon />
                    </AlertDialogMedia>
                    <AlertDialogTitle>Delete role?</AlertDialogTitle>
                    <AlertDialogDescription>
                        This will permanently delete the role "{role.name}".
                        This action cannot be undone.
                    </AlertDialogDescription>
                </AlertDialogHeader>
                <Form {...roles.destroy.form(role.uuid)}>
                    {({ processing }) => (
                        <AlertDialogFooter>
                            <AlertDialogCancel variant="outline">
                                Cancel
                            </AlertDialogCancel>
                            <AlertDialogAction
                                variant={'destructive'}
                                type="submit"
                            >
                                {processing && <Spinner />}
                                Delete
                            </AlertDialogAction>
                        </AlertDialogFooter>
                    )}
                </Form>
            </AlertDialogContent>
        </AlertDialog>
    );
}
