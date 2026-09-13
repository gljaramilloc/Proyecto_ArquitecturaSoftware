<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRegistrationWithDefaultStatusTest extends TestCase
{
    public function test_user_can_be_created_when_default_status_exists(): void
    {
        $this->artisan('migrate:fresh')->assertExitCode(0);

        $user = User::create([
            'name' => 'samuel',
            'email' => 'madrid@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'madrid@gmail.com',
            'status_id' => 1,
        ]);
    }
}
