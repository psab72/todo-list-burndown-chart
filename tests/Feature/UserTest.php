<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Test fields that are required for registration.
     */
    public function testRequiredFieldsForRegistration()
    {
        $this->json('POST', 'register', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => ["The name field is required."],
                    "email" => ["The email field is required."],
                    "password" => ["The password field is required."],
                ]
            ]);
    }

    /**
     * Test password confirmation.
     */
    public function testRepeatPassword()
    {
        $userData = [
            "name" => "Juan Dela Cruz",
            "email" => "juandelacruz@gmail.com",
            "password" => "password"
        ];

        $this->json('POST', 'register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "password" => ["The password confirmation does not match."]
                ]
            ]);
    }
}
