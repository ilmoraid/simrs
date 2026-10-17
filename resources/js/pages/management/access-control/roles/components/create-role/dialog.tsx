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
    DialogTrigger,
} from '@/components/ui/dialog';
import { Plus } from 'lucide-react';
import roles from '@/routes/management/access-control/roles';
import { Spinner } from '@/components/ui/spinner';

export function CreateRoleDialog() {
    return (
        <Dialog>
            <DialogTrigger asChild>
                <Button className="gap-2">
                    <Plus data-icon="inline-start" />
                    Create new role
                </Button>
            </DialogTrigger>
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Create a new role</DialogTitle>
                    <DialogDescription>
                        Start with a name and description. You can configure
                        permissions next.
                    </DialogDescription>
                </DialogHeader>

                <Form
                    {...roles.store.form()}
                    resetOnSuccess={['name', 'description']}
                    className="flex flex-col gap-4"
                >
                    {({ processing, errors }) => (
                        <>
                            <div className="grid gap-2">
                                <Label htmlFor="name">Role Name</Label>
                                <Input
                                    id="name"
                                    name="name"
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
                                    Create role
                                </Button>
                            </DialogFooter>
                        </>
                    )}
                </Form>
            </DialogContent>
        </Dialog>
    );
}
