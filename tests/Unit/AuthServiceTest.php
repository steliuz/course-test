<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthServiceTest extends TestCase
{
    use RefreshDatabase;

    private AuthService $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authService = new AuthService();
    }

    public function test_login_with_valid_credentials_returns_true()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123')
        ]);

        $result = $this->authService->login('test@example.com', 'password123');

        $this->assertTrue($result);
        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id, Auth::id());
    }

    public function test_login_with_invalid_credentials_returns_false()
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123')
        ]);

        $result = $this->authService->login('test@example.com', 'wrongpassword');

        $this->assertFalse($result);
        $this->assertFalse(Auth::check());
    }

    public function test_register_creates_new_user_and_logs_in()
    {
        $result = $this->authService->register(
            'Test User',
            'test@example.com',
            'password123',
            '+568398789389'
        );

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'father',
            'phone' => '+568398789389'
        ]);

        $this->assertTrue(Auth::check());
        $this->assertEquals($result->id, Auth::id());
        $this->assertEquals('Test User', $result->name);
        $this->assertEquals('test@example.com', $result->email);
        $this->assertEquals('father', $result->role);
    }

    public function test_register_hashes_password()
    {
        $result = $this->authService->register(
            'Test User',
            'test@example.com',
            'password123',
            '+568398789389'
        );

        $this->assertTrue(Hash::check('password123', $result->password));
    }
}
