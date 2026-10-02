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
import { type NavItem } from '@/types/layouts/nav-item';

/**
 * Filter navigation items recursively based on user permissions.
 * Prunes parent groups/dropdowns if all child items are unauthorized.
 */
function useAuthorizedTree(items: NavItem[]): NavItem[] {
    const { can, canAny } = usePermissions();

    const filterNodes = (nodes: NavItem[]): NavItem[] => {
        return nodes
            .map((node) => {
                // Check if user has permission for the current node
                let hasAccess = true;
                if (typeof node.permission === 'string') {
                    hasAccess = can(node.permission);
                } else if (Array.isArray(node.permission)) {
                    hasAccess = canAny(node.permission);
                }

                // If node has children, process child items first
                if (Array.isArray(node.items) && node.items.length > 0) {
                    const authorizedChildren = filterNodes(node.items);

                    // Keep parent group ONLY if it has accessible children and passes its own permission check
                    if (authorizedChildren.length > 0 && hasAccess) {
                        return { ...node, items: authorizedChildren };
                    }
                    return null;
                }

                // Leaf node check
                return hasAccess ? node : null;
            })
            .filter((node): node is NavItem => node !== null);
    };

    return filterNodes(items);
}

export function NavMain({ items }: { items: NavItem[] }) {
    const { isCurrentUrl } = useCurrentUrl();
    const authorizedItems = useAuthorizedTree(items);

    // Render nothing if no items pass permission checks
    if (authorizedItems.length === 0) {
        return null;
    }

    return (
        <SidebarGroup className="px-2 py-0">
            <SidebarGroupLabel>Platform</SidebarGroupLabel>
            <SidebarMenu>
                {authorizedItems.map((item) => {
                    const hasChildren =
                        Array.isArray(item.items) && item.items.length > 0;
                    const itemHref = item.href ?? item.href ?? '#';

                    // 1. Single leaf navigation item
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
                        const subHref = sub.href ?? sub.href ?? '';
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
                                    <SidebarMenuButton tooltip={item.title}>
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
                                                subItem.href ??
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
                                                            href={subHref}
                                                            prefetch
                                                        >
                                                            {subItem.icon && (
                                                                <subItem.icon />
                                                            )}
                                                            <span>
                                                                {subItem.title}
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
    );
}
