<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\IngredientResource as Resource;
use App\Models\Ingredient as Model;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Model $ingredient)
    {
        return Resource::collection($ingredient->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Model $ingredient, Request $request)
    {
        /**
         * Check if the request data is correct
         * In case is there any data incorrect will return 422 error
         */
        $validated = $request->validate([
            'name' => 'required',
            'measure' => 'required',
            'supplier' => 'required',
        ]);
        /**
         * @success: insert data into the database 
         */
        $ingredient->name = $request->name;
        $ingredient->measure = $request->measure;
        $ingredient->supplier = $request->supplier;

        $ingredient->save();
        return [
            'response' => 'the ingredient created successfully',
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
