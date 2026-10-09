import { Search, Filter } from 'lucide-react';
import { Input } from '@/components/ui/input';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';

interface RoleFiltersProps {
    query: string;
    onQueryChange: (value: string) => void;
    filter: string;
    onFilterChange: (value: string) => void;
}

export function RoleFilters({
    query,
    onQueryChange,
    filter,
    onFilterChange,
}: RoleFiltersProps) {
    return (
        <div className="mb-6 flex flex-col gap-3 sm:flex-row">
            <div className="relative flex-1">
                <Search className="pointer-events-none absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
                <Input
                    value={query}
                    onChange={(e) => onQueryChange(e.target.value)}
                    placeholder="Search roles..."
                    className="h-10 pl-9"
                />
            </div>

            <Select value={filter} onValueChange={onFilterChange}>
                <SelectTrigger className="h-10 w-full sm:w-52">
                    <Filter className="mr-2 h-4 w-4 text-muted-foreground" />
                    <SelectValue placeholder="Filter by type" />
                </SelectTrigger>
                <SelectContent>
                    <SelectItem value="all">All role types</SelectItem>
                    <SelectItem value="system">System default</SelectItem>
                    <SelectItem value="custom">Custom roles</SelectItem>
                </SelectContent>
            </Select>
        </div>
    );
}
