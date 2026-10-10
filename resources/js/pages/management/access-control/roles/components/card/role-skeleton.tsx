import {
    Card,
    CardHeader,
    CardContent,
    CardFooter,
} from '@/components/ui/card';
import { Skeleton } from '@/components/ui/skeleton';
import { cn } from '@/lib/utils';

type RoleCardSkeletonProps = {
    count?: number;
    className?: string;
};

export function RoleCardSkeleton({
    count = 4,
    className,
}: RoleCardSkeletonProps) {
    return (
        <div
            className={cn(
                'grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4',
                className,
            )}
        >
            {Array.from({ length: count }, (_, index) => (
                <CardSkeleton key={`role-skeleton-${index}`} />
            ))}
        </div>
    );
}

function CardSkeleton() {
    return (
        <Card className="flex flex-col overflow-hidden border-border/70 bg-card">
            <CardHeader className="gap-4 pb-4">
                {/* Top bar: Icon & Action dropdown */}
                <div className="flex items-start justify-between gap-3">
                    <Skeleton className="size-10 rounded-xl" />
                    <Skeleton className="size-8 rounded-md" />
                </div>

                {/* Title, Badge & Description */}
                <div>
                    <div className="flex items-center gap-2">
                        <Skeleton className="h-5 w-32" />
                        <Skeleton className="h-4 w-12 rounded-full" />
                    </div>
                    <div className="mt-2 space-y-1.5">
                        <Skeleton className="h-4 w-full" />
                        <Skeleton className="h-4 w-4/5" />
                    </div>
                </div>
            </CardHeader>

            <CardContent className="flex flex-1 flex-col gap-5 pt-0">
                {/* Assigned users & Permissions count */}
                <div className="flex items-center justify-between">
                    <div>
                        <Skeleton className="mb-2 h-3 w-20" />
                        <div className="flex items-center -space-x-2">
                            {Array.from({ length: 3 }).map((_, i) => (
                                <Skeleton
                                    key={i}
                                    className="size-7 rounded-full border-2 border-background"
                                />
                            ))}
                        </div>
                    </div>
                    <div className="flex flex-col items-end">
                        <Skeleton className="mb-2 h-3 w-20" />
                        <Skeleton className="h-5 w-10 rounded-md" />
                    </div>
                </div>

                {/* Progress bar */}
                <Skeleton className="h-1.5 w-full rounded-full" />
            </CardContent>

            <CardFooter className="justify-between border-t border-border/60 bg-muted/20 py-3">
                <Skeleton className="h-3 w-24" />
                <Skeleton className="h-8 w-24 rounded-md" />
            </CardFooter>
        </Card>
    );
}
