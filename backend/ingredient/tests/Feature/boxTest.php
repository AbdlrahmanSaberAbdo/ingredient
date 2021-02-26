<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class boxTest extends TestCase
{
    /**
     * Test required fields response
     * @return void
     */
    public function testRequiredFieldsForCreateBoxes()
    {
        $this->json('POST', 'api/boxes', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "delivery_date",
                    "recipe_ids",
                    "customer_id",
                ]
            ]);
    }

    /**
     * Test success message when create a message
     * @return void
     */
    public function testSuccesfulCreateBoxes()
    {
        /**
         * Add +2 days (48 + 1) hours to current date
         */
        $date = Date('y-m-d', strtotime('3days'));
        $boxData = [
            "delivery_date" => $date,
            "recipe_ids" => [1,2,3],
            "customer_id" => 1,
        ];
        $this->json('POST', 'api/boxes', $boxData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "response",
                "code"
            ]);
    }

    /**
     * Test fetching boxes 
     * @return void
     */
    public function testgetBoxes()
    {
        $this->json('GET', 'api/boxes', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    [
                        "id",
                        "delivery_date",
                        "recipes" => [
                            [
                                "id",
                                "name",
                                "description"
                            ]
                        ],
                    ]
                ]
            ]);
    }
}
