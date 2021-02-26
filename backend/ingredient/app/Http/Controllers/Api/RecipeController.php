<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RecipeResource as Resource;
use App\Models\Recipe as Model;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Model $recipe)
    {
        return Resource::collection($recipe->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Model $recipe)
    {
        /**
         * Check if the request data is correct
         * In case is there any data incorrect will return 422 error
         */
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'ingredients' => 'required'
        ]);

        /**
         * @success: insert the recipe data first into the database 
         */
        $recipe->name = $request->name;
        $recipe->description = $request->description;
        $recipe->save();
        
        if($request->ingredients) {
            foreach($request->ingredients as $ingredient) {
                $recipe->ingredients()->attach($ingredient['id'], ['amount'=> $ingredient['amount']]);
            }
        }
        return [
            'response' => 'the recipe created successfully',
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
}
