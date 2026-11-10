<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'lastNames' => fake()->lastName().' '.fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'phoneNumber' => '+57 3'.fake()->numerify('## ### ####'),
            'address' => fake()->streetAddress().', '.fake()->randomElement([
                'El Poblado, Medellin',
                'Laureles, Medellin',
                'Envigado, Antioquia',
                'Chapinero Alto, Bogota',
                'Usaquen, Bogota',
                'Bocagrande, Cartagena',
                'Ciudad Jardin, Cali',
            ]),
            'password' => static::$password ??= Hash::make('password'),
            'status_id' => fn (): int => Status::where('name', 'Active')->first()?->getId()
                ?? Status::firstOrCreate(['name' => 'Active'])->getId(),
            'role' => 'customer',
            'balance' => fake()->randomFloat(2, 1500, 12500),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (): array => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user has administrator privileges.
     */
    public function admin(): static
    {
        return $this->state(fn (): array => [
            'role' => 'admin',
            'balance' => 25000.00,
        ]);
    }
}
