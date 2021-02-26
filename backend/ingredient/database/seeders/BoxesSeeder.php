<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
class BoxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++) {
            DB::table('boxes')->insert([
                'delivery_date' =>"2021-02".'-'.($i+15),
                'customer_id' => Customer::all()->random()->id,
            ]);
        }
    }
}
