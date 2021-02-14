<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;
use App\Models\User;
use RuntimeException;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTest extends TestCase
{

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

    public function testSuccessfulRegistration()
    {
        $userData = [
            "name" => "John Doe",
            "email" => "doe@example.com",
            "password" => "password",
            "password_confirmation" => "password"
        ];

        $this->json('POST', 'api/auth/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
                "message"
            ]);
    }

    public function testSuccessfulLogin()
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

    public function testSuccessfulGetInfo()
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

    public function testSuccessfulLogout()
    {
        $this->json('POST', 'api/auth/logout', [
            'token' => $this->token()
        ], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "message"
            ]);
    }

    public function testSuccessfulRefreshToken()
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
