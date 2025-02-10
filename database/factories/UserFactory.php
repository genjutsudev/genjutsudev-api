<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id = uniqid();

        return [
            'profilelink' => $id,
            'profilename' => $id,
            'email' => fake()->unique()->safeEmail(),
            'type' => 'regular',
            'token' => self::hash(),
            'activity_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
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
