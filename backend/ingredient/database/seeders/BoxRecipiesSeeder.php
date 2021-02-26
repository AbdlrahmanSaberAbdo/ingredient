<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Box;
use App\Models\Recipe;
class BoxRecipiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++) {
            DB::table('box_recipies')->insert([
                'box_id' => Box::all()->random()->id,
                'recipe_id' => Recipe::all()->random()->id,
            ]);
        }
    }
}
