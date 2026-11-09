<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\StatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRegistrationWithDefaultStatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verify that a newly registered user receives the default active status when base statuses are seeded.
     */
    public function test_user_can_be_created_when_default_status_exists(): void
    {
        $this->seed(StatusSeeder::class);

        $user = User::create([
            'name' => 'samuel',
            'email' => 'madrid@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->getId(),
            'email' => 'madrid@gmail.com',
            'status_id' => 1,
        ]);
    }
}
