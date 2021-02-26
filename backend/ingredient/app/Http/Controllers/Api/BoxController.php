<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BoxResource as Resource;
use Illuminate\Support\Facades\DB;
use App\Models\Box as Model;
use Carbon\Carbon;
class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Model $box)
    {
        return Resource::collection($box->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Model $box, Request $request)
    {
        /**
         * ====== validate the data =======
         */
        $validated = $request->validate([
            'delivery_date' => 'required|date|after:+48 hours',
            'recipe_ids' => 'required|max:4',
            'customer_id' => 'required',
        ]);

        /**
         * @success: insert the box data first into the database 
         * @error: return error response with reason 
         */
        $box->delivery_date = $request->delivery_date;
        $box->customer_id = $request->customer_id;
        $box->save();
        if($request->recipe_ids) {
            foreach($request->recipe_ids as $recipe_id) {
                /**
                 * check if recipe id is in database or not 
                 * insert recipe in database assoicate with id of the created box
                 */
                $box->recipes()->attach($recipe_id);
            }
        }

        return [
            'response' => 'the box created successfully',
            'code' => 200,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function order_ingreients(Model $box, Request $request, $order_date) {
        /**
         * I can enhacment the returned data but because of time I made it now like it
         */
        $ingredients = $this->getOrderedIngredientsWithDateQuery($order_date);
        return [
            'ingredients' => $ingredients,
            'code' => 200,
        ];
    }
    private function getOrderedIngredientsWithDateQuery($order_date) {
        /**
         * get orders for the 7 days from the order_date.
         * get current date
         */
        $before_seven_days = Carbon::create($order_date)->subDays(7);
        $current = Carbon::now();

        /**
         * create a query to get the all ingredients  the ingredients and amount of each ingredient 
         * which should be ordered to fulfill all orders for the 7 days from the order_date
         */
        return DB::select(
            "
            SELECT CONCAT(ri.amount, i.measure) AS amount, i.id, i.name, b.delivery_date FROM 
            `boxes` as b INNER JOIN box_recipies as br on b.id = br.box_id
            INNER JOIN ingredients as i
            INNER JOIN recipe_ingredients as ri on ri.recipe_id = br.recipe_id and i.id = ri.ingredient_id
            where b.delivery_date > '$before_seven_days' and b.delivery_date <= '$order_date'
            "
        );
    }
}
