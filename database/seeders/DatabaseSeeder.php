<?php

namespace Database\Seeders;

use App\Models\Tenant\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tenant1 = Tenant::create();
        $tenant1->domains()->create([
            'domain' => 'foo.'.config('tenancy.central_domains')[2],
        ]);

        $tenant2 = Tenant::create();
        $tenant2->domains()->create([
            'domain' => 'bar.'.config('tenancy.central_domains')[2],
        ]);
    }
}
