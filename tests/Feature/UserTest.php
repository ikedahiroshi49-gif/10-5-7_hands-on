<?php

namespace Tests\Feature;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_created()
    {
        $user = User::factory()->create([
            'name' => 'TestUser',
            'email' => 'Test@example.com',
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'TestUser',
            'email' => 'Test@example.com'
        ]);
    }
    public function test_cannot_create_user_with_duplicate_email()
    {
        User::factory()->create([
            'name' => 'TestUser1',
            'email' => 'Test@example.com',
        ]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        User::factory()->create([
            'name' => 'TestUser2',
            'email' => 'Test@example.com',
        ]);
    }
}

