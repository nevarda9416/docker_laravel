<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BasicFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testUserCanViewLogin(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login')->assertSee('Login');
    }

    public function testUserCanLogin(): void
    {
        $this->assertGuest();
        $user = User::factory()->create([
            'password' => bcrypt('feature'),
        ]);
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'feature',
        ])
            ->assertStatus(302)
            ->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function testUserCannotLoginWithIncorrectPassword(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('laravel'),
        ]);
        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testUserCanViewRegister(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register')->assertSee('register');
    }

    public function testUserCanRegister(): void
    {
        $this->assertGuest();
        $user = User::factory()->create();
        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'success-feature',
            'password_confirmation' => 'success-feature',
        ]);
        $response->assertStatus(302)->assertRedirect('/');
    }
}
