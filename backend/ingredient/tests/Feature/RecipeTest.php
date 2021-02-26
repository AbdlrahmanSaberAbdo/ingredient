<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    /**
     * test required fields response
     *
     * @return void
     */
    public function testRequiredFieldsForCreateRecipe()
    {
        $this->json('POST', 'api/recipes', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "name",
                    "description",
                    "ingredients"
                ]
            ]);
   
    }

    /**
     * Test success message when create a message
     * @return void
    */
    public function testSuccesfulCreateRecipe()
    {
        $recipeData = [
            "name" => "ingredient_test",
            "description" => "desiption test",
            "ingredients" => [
                [
                    "id" => 4,
                    "amount" => 20
                ],
                [
                    "id" => 2,
                    "amount" => 202
                ]
            ] 
        ];
        $this->json('POST', 'api/recipes', $recipeData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "response",
                "code"
        ]);
    }

    /**
     * Test fetching recipes 
     * @return void
     */
    public function testgetIngredient()
    {
        $this->json('GET', 'api/recipes', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    [
                        "id",
                        "name",
                        "description",
                        "ingredients"
                    ]
                ]
            ]);
    }
}
