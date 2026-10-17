import { Form } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import InputError from '@/components/input-error';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import roles from '@/routes/management/access-control/roles';
import { Spinner } from '@/components/ui/spinner';
import { Role } from '@/types';

type UpdateRoleDialogProps = {
    role: Role;
    open: boolean;
    onOpenChange: (open: boolean) => void;
};

export function UpdateRoleDialog({
    role,
    open,
    onOpenChange,
}: UpdateRoleDialogProps) {
    return (
        <Dialog open={open} onOpenChange={onOpenChange}>
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Edit role</DialogTitle>
                    <DialogDescription>
                        Update the name or description for this role.
                    </DialogDescription>
                </DialogHeader>

                <Form
                    {...roles.update.form(role.uuid)}
                    transform={(data) => ({
                        ...data,
                        name: data.name ?? role.name,
                        description: data.description ?? role.description,
                    })}
                    className="flex flex-col gap-4"
                >
                    {({ processing, errors }) => (
                        <>
                            <div className="grid gap-2">
                                <Label htmlFor="name">Role Name</Label>
                                <Input
                                    id="name"
                                    name="name"
                                    defaultValue={role.name}
                                    placeholder="e.g. Content Manager"
                                    tabIndex={1}
                                />
                                <InputError message={errors.name} />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="description">Description</Label>
                                <Textarea
                                    id="description"
                                    name="description"
                                    defaultValue={role.description ?? ''}
                                    placeholder="What can this role do?"
                                    tabIndex={2}
                                />
                                <InputError message={errors.description} />
                            </div>

                            <DialogFooter className="mt-2">
                                <Button
                                    type="submit"
                                    disabled={processing}
                                    tabIndex={3}
                                >
                                    {processing && <Spinner />}
                                    Save changes
                                </Button>
                            </DialogFooter>
                        </>
                    )}
                </Form>
            </DialogContent>
        </Dialog>
    );
}
