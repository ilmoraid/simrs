import { Link } from '@inertiajs/react';
import { ChevronRight } from 'lucide-react';

import {
    Collapsible,
    CollapsibleContent,
    CollapsibleTrigger,
} from '@/components/ui/collapsible';
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from '@/components/ui/sidebar';
import { useCurrentUrl } from '@/hooks/use-current-url';
import { usePermissions } from '@/hooks/use-permissions';
import type { NavItem } from '@/types/layouts/nav-item';
import type { NavGroup } from '@/types';

/**
 * Filter navigation items recursively based on permissions.
 */
function filterNavItems(
    nodes: NavItem[],
    can: (p: string) => boolean,
    canAny: (p: string[]) => boolean,
): NavItem[] {
    return nodes
        .map((node) => {
            let hasAccess = true;
            if (typeof node.permission === 'string') {
                hasAccess = can(node.permission);
            } else if (Array.isArray(node.permission)) {
                hasAccess = canAny(node.permission);
            }

            if (Array.isArray(node.items) && node.items.length > 0) {
                const authorizedChildren = filterNavItems(
                    node.items,
                    can,
                    canAny,
                );
                if (authorizedChildren.length > 0 && hasAccess) {
                    return { ...node, items: authorizedChildren };
                }
                return null;
            }

            return hasAccess ? node : null;
        })
        .filter((node): node is NavItem => node !== null);
}

/**
 * Filter groups (modules). Hides whole group if all items are unauthorized.
 */
function useAuthorizedGroups(groups: NavGroup[]): NavGroup[] {
    const { can, canAny } = usePermissions();

    return groups
        .map((group) => {
            let hasAccess = true;
            if (typeof group.permission === 'string') {
                hasAccess = can(group.permission);
            } else if (Array.isArray(group.permission)) {
                hasAccess = canAny(group.permission);
            }

            if (!hasAccess) return null;

            const authorizedItems = filterNavItems(group.items, can, canAny);
            if (authorizedItems.length === 0) return null;

            return {
                ...group,
                items: authorizedItems,
            };
        })
        .filter((group): group is NavGroup => group !== null);
}

export function NavMain({ groups }: { groups: NavGroup[] }) {
    const { isCurrentUrl } = useCurrentUrl();
    const authorizedGroups = useAuthorizedGroups(groups);

    if (authorizedGroups.length === 0) {
        return null;
    }

    return (
        <div className="space-y-2">
            {authorizedGroups.map((group, groupIdx) => (
                <SidebarGroup
                    key={group.title ?? `group-${groupIdx}`}
                    className="px-2 py-0"
                >
                    {group.title && (
                        <SidebarGroupLabel>{group.title}</SidebarGroupLabel>
                    )}
                    <SidebarMenu>
                        {group.items.map((item) => {
                            const hasChildren =
                                Array.isArray(item.items) &&
                                item.items.length > 0;
                            const itemHref = item.href ?? item.url ?? '#';

                            // 1. Leaf link item
                            if (!hasChildren) {
                                return (
                                    <SidebarMenuItem key={item.title}>
                                        <SidebarMenuButton
                                            asChild
                                            isActive={isCurrentUrl(itemHref)}
                                            tooltip={item.title}
                                        >
                                            <Link href={itemHref} prefetch>
                                                {item.icon && <item.icon />}
                                                <span>{item.title}</span>
                                            </Link>
                                        </SidebarMenuButton>
                                    </SidebarMenuItem>
                                );
                            }

                            // 2. Collapsible parent dropdown item
                            const isChildActive = item.items?.some((sub) => {
                                const subHref = sub.href ?? sub.url ?? '';
                                return subHref ? isCurrentUrl(subHref) : false;
                            });

                            return (
                                <Collapsible
                                    key={item.title}
                                    asChild
                                    defaultOpen={isChildActive}
                                    className="group/collapsible"
                                >
                                    <SidebarMenuItem>
                                        <CollapsibleTrigger asChild>
                                            <SidebarMenuButton
                                                tooltip={item.title}
                                            >
                                                {item.icon && <item.icon />}
                                                <span>{item.title}</span>
                                                <ChevronRight className="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                                            </SidebarMenuButton>
                                        </CollapsibleTrigger>

                                        <CollapsibleContent>
                                            <SidebarMenuSub>
                                                {item.items?.map((subItem) => {
                                                    const subHref =
                                                        subItem.href ??
                                                        subItem.url ??
                                                        '#';

                                                    return (
                                                        <SidebarMenuSubItem
                                                            key={subItem.title}
                                                        >
                                                            <SidebarMenuSubButton
                                                                asChild
                                                                isActive={isCurrentUrl(
                                                                    subHref,
                                                                )}
                                                            >
                                                                <Link
                                                                    href={
                                                                        subHref
                                                                    }
                                                                    prefetch
                                                                >
                                                                    {subItem.icon && (
                                                                        <subItem.icon />
                                                                    )}
                                                                    <span>
                                                                        {
                                                                            subItem.title
                                                                        }
                                                                    </span>
                                                                </Link>
                                                            </SidebarMenuSubButton>
                                                        </SidebarMenuSubItem>
                                                    );
                                                })}
                                            </SidebarMenuSub>
                                        </CollapsibleContent>
                                    </SidebarMenuItem>
                                </Collapsible>
                            );
                        })}
                    </SidebarMenu>
                </SidebarGroup>
            ))}
        </div>
    );
}
