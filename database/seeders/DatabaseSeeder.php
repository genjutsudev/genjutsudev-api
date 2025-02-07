<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

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
            'api_key' => self::hash(),
        ]);
    }

    private function uuid(): string
    {
        return Uuid::uuid4()->toString();
    }

    private function hash(string $algo = 'sha256'): string
    {
        return hash($algo, self::uuid());
    }
}
