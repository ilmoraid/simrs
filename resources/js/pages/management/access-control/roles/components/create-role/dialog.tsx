import { Plus } from 'lucide-react';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import { toast } from 'sonner';

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
                <Input placeholder="Role name" />
                <Textarea placeholder="What can this role do?" />
                <DialogFooter>
                    <Button onClick={() => toast.success('Role created')}>
                        Create role
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    );
}
