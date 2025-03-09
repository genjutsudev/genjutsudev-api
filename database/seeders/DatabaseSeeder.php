<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Helpers\Generator;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // default user:root
        User::factory()->create([
            'email' => 'root@example.com',
            'password' => Hash::make('secret'),
            'gender' => 'male',
            'type' => 'admin',
            'is_active' => true,
        ]);

        // default user:api
        User::factory()->create([
            'profilelink' => null,
            'profilename' => null,
            'email' => null,
            'type' => 'api',
            'token' => null,
            'is_active' => true,
            'api_key' => Generator::generateToken('sha512'),
        ]);
    }
}
