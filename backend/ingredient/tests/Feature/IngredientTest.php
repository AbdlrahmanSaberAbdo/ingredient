<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Ingredient;
class IngredientTest extends TestCase
{
    /**
     * Test required fields response
     * @return void
     */
    public function testRequiredFieldsForCreateIngredient()
    {
        $this->json('POST', 'api/ingredients', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "name",
                    "measure",
                    "supplier",
                ]
            ]);
    }

    /**
     * Test success message when create a message
     * @return void
     */
    public function testSuccesfulCreateIngredient()
    {
        $ingredientData = [
            "name" => "ingredient_test",
            "measure" => "kg",
            "supplier" => "supplier_Test",
        ];
        $this->json('POST', 'api/ingredients', $ingredientData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "response",
                "code"
            ]);
    }

    /**
     * Test fetching ingredients 
     * @return void
     */
    public function testgetIngredient()
    {
        $this->json('GET', 'api/ingredients', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    [
                        "id",
                        "name",
                        "measure",
                        "supplier"
                    ]
                ]
            ]);
    }

    /**
     * get ordered Ingredients 
     * @return void
    */
    public function testGetOrderedIngredients()
    {
        $order_date = "2021-03-01";
        $this->json('GET', 'api/'.$order_date.'/ingredients', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "ingredients" => [ ]
            ]);
    }

}
