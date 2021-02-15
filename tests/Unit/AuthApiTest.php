<?php

namespace Tests\Unit;

use App\Models\User;
use RuntimeException;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class AuthApiTest extends TestCase
{
    use WithFaker;

    protected function token(): string
    {
        $loginData = [
            "email" => "doe@example.com",
            "password" => "password"
        ];

        $response = $this->json('POST', 'api/auth/login', $loginData, [
            'Accept' => 'application/json'
        ])->assertStatus(200)
            ->assertJsonStructure([
                "access_token",
                "token_type",
                "expires_in"
            ]);
        $content = json_decode($response->getContent());

        if (!isset($content->access_token)) {
            throw new RuntimeException('Token missing in response');
        }

        return $content->access_token;
    }

    /** @test */
    public function testSuccessfulRegistration(): void
    {
        $userData = [];
        $checkUser = User::where('email', '=', 'doe@example.com')->first();
        if (empty($checkUser)) {
            $userData = [
                "name" => "John Doe",
                "email" => "doe@example.com",
                "password" => "password",
                "password_confirmation" => "password"
            ];
        } else {
            $userData = [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => 'password',
                'password_confirmation' => 'password'
            ];
        }

        $response = $this->post('api/auth/register', $userData);
        $response->assertStatus(200);
    }

    /** @test */
    public function testSuccessfulLogin(): void
    {
        $loginData = [
            "email" => "doe@example.com",
            "password" => "password"
        ];

        $this->json('POST', 'api/auth/login', $loginData, [
            'Accept' => 'application/json'
        ])->assertStatus(200)
            ->assertJsonStructure([
                "access_token",
                "token_type",
                "expires_in"
            ]);
    }

    /** @test */
    public function testSuccessfulGetInfo(): void
    {
        $this->json('POST', 'api/auth/me', [
            'token' => $this->token()
        ], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "id",
                "name",
                "email",
                "email_verified_at",
                "created_at",
                "updated_at",
            ]);
    }

    /** @test */
    public function testSuccessfulLogout(): void
    {
        $this->json('POST', 'api/auth/logout', [
            'token' => $this->token()
        ], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "message"
            ]);
    }

    /** @test */
    public function testSuccessfulRefreshToken(): void
    {
        $this->json('POST', 'api/auth/refresh', [
            'token' => $this->token()
        ], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "access_token",
                "token_type",
                "expires_in"
            ]);
    }
}
