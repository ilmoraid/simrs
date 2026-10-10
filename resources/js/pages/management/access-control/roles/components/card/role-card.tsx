import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import type { Role } from '@/types';
import { ChevronDown, MoreHorizontal, ShieldCheck, Trash2 } from 'lucide-react';
import { toast } from 'sonner';
import { UserAvatars } from './user-avatar';

type RoleCardProps = {
    role: Role;
    totalPermission?: number;
};

export function RoleCard({ role, totalPermission }: RoleCardProps) {
    return (
        <Card className="group flex flex-col overflow-hidden border-border/70 bg-card transition-all duration-200 hover:-translate-y-0.5 hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5">
            <CardHeader className="gap-4 pb-4">
                <div className="flex items-start justify-between gap-3">
                    <div
                        className={`flex size-10 items-center justify-center rounded-xl bg-primary/10`}
                    >
                        <ShieldCheck className="size-5 text-primary" />
                    </div>
                    <DropdownMenu>
                        <DropdownMenuTrigger asChild>
                            <Button
                                variant="ghost"
                                size="icon"
                                className="-mt-2 -mr-2 text-muted-foreground"
                            >
                                <MoreHorizontal />
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end">
                            <DropdownMenuItem>Edit role</DropdownMenuItem>
                            <DropdownMenuItem
                                onClick={() => toast.success('Role duplicated')}
                            >
                                Duplicate
                            </DropdownMenuItem>
                            {role.is_system === false && (
                                <>
                                    <DropdownMenuSeparator />
                                    <DropdownMenuItem
                                        className="text-destructive"
                                        onClick={() =>
                                            toast.success('Role deleted')
                                        }
                                    >
                                        <Trash2 data-icon="inline-start" />
                                        Delete role
                                    </DropdownMenuItem>
                                </>
                            )}
                        </DropdownMenuContent>
                    </DropdownMenu>
                </div>
                <div>
                    <div className="flex flex-wrap items-center gap-2">
                        <CardTitle className="text-base">{role.name}</CardTitle>
                        <Badge
                            variant={
                                role.is_system === true
                                    ? 'default'
                                    : 'secondary'
                            }
                            className="text-[10px]"
                        >
                            {role.is_system ? 'System Default' : 'Custom'}
                        </Badge>
                    </div>
                    <CardDescription className="mt-2 line-clamp-2 leading-relaxed">
                        {role.description}
                    </CardDescription>
                </div>
            </CardHeader>
            <CardContent className="flex flex-1 flex-col gap-5 pt-0">
                <div className="flex items-center justify-between">
                    <div>
                        <p className="mb-2 text-[11px] font-medium tracking-wider text-muted-foreground uppercase">
                            Assigned users
                        </p>
                        <UserAvatars
                            users={role.users}
                            count={role.total_users ?? 0}
                        />
                    </div>
                    <div className="text-right">
                        <p className="mb-2 text-[11px] font-medium tracking-wider text-muted-foreground uppercase">
                            Permissions
                        </p>
                        <Badge variant="outline" className="font-mono text-xs">
                            {role.total_permissions}
                        </Badge>
                    </div>
                </div>
                <div className="h-1.5 overflow-hidden rounded-full bg-muted">
                    <div
                        className="h-full rounded-full bg-primary"
                        style={{
                            width: `${(Number(role.total_permissions) / Number(totalPermission)) * 100}%`,
                        }}
                    />
                </div>
            </CardContent>
            <CardFooter className="justify-between border-t border-border/60 bg-muted/20 py-3">
                <span className="text-xs text-muted-foreground">
                    Updated {role.updated_at?.human}{' '}
                </span>
                <Button
                    variant="ghost"
                    size="sm"
                    className="-mr-2 gap-1 text-primary"
                >
                    View details <ChevronDown className="-rotate-90" />
                </Button>
            </CardFooter>
        </Card>
    );
}
