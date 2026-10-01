<?php

namespace Database\Seeders\Tenant\User;

use App\Models\User\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory([
            'email' => 'admin@ilmora.id',
        ])->create();

        User::factory()->unverified()->count(5)->create();
    }
}
