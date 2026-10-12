export default function RoleHeader() {
    return (
        <div>
            <p className="mb-2 text-xs font-semibold tracking-[0.18em] text-primary uppercase">
                Access control
            </p>
            <h1 className="text-3xl font-semibold tracking-tight sm:text-4xl">
                Roles & permissions
            </h1>
            <p className="mt-2 max-w-xl text-muted-foreground">
                Manage system user roles, access levels, and assign permissions
                across your organization.
            </p>
        </div>
    );
}
