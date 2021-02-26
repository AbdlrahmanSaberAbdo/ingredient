<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Ingredient;
use App\Models\Recipe;
class RecipeIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++) {
            DB::table('recipe_ingredients')->insert([
                'ingredient_id' => Ingredient::all()->random()->id,
                'recipe_id'     => Recipe::all()->random()->id,
                'amount'      => rand(100, 200)
            ]);
        }
    }
}
