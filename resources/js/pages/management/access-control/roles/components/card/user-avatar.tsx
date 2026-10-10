import { Avatar, AvatarFallback } from '@/components/ui/avatar';
import { useInitials } from '@/hooks/use-initials';
import type { User } from '@/types';

type UserAvatarsProps = {
    users?: User[];
    count?: number;
};

const BACKGROUND_COLORS = ['bg-indigo-500', 'bg-slate-700', 'bg-cyan-600'];

export function UserAvatars({ users = [], count = 0 }: UserAvatarsProps) {
    const getInitials = useInitials();

    return (
        <div className="flex items-center">
            <div className="flex -space-x-2">
                {users.map((user, index) => (
                    <Avatar
                        key={user.uuid}
                        className="size-7 border-2 border-card"
                    >
                        <AvatarFallback
                            className={`text-[10px] font-semibold text-white ${
                                BACKGROUND_COLORS[
                                    index % BACKGROUND_COLORS.length
                                ]
                            }`}
                        >
                            {getInitials(user.name)}
                        </AvatarFallback>
                    </Avatar>
                ))}
            </div>

            {count > 3 && (
                <span className="ml-2 text-xs font-medium text-muted-foreground">
                    +{count - 3} others
                </span>
            )}
        </div>
    );
}
