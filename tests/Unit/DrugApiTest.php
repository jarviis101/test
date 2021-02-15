<?php

namespace Tests\Unit;

use RuntimeException;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Drug;

class DrugApiTest extends TestCase
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

    /** @test */
    public function testSuccessfulGetDrugs(): void
    {
        $response = $this->json('GET', 'api/v1/drugs', [
            'token' => $this->token()
        ], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [[
                    "id",
                    "name",
                    "price",
                    "ingredient_id",
                    "manufacturer_id",
                    "created_at",
                    "updated_at"
                ]]
            ]);
    }

    /** @test */
    public function testSuccessfulGetDrugById(): void
    {
        $drug = Drug::factory()->create();
        $this->json('GET', 'api/v1/drugs', [
            'id' => $drug->id,
            'token' => $this->token()
        ], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [[
                    "id",
                    "name",
                    "price",
                    "ingredient_id",
                    "manufacturer_id",
                    "created_at",
                    "updated_at"
                ]]
            ]);
    }
}
