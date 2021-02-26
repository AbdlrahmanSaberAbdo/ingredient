<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['g', 'kg', 'm', 'pieces'];
        for($i = 0; $i < 10; $i++) {
            DB::table('ingredients')->insert([
                'name'     => Str::random(10),
                'measure'  => $arr[array_rand($arr)],
                'supplier' => 'supplier_'.$i,
            ]);
        }
    }
}
