<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Ingredients */
Route::apiResource('ingredients','App\Http\Controllers\Api\IngredientController');

/* Recipes */
Route::apiResource('recipes','App\Http\Controllers\Api\RecipeController');

/* boxes */
Route::apiResource('boxes','App\Http\Controllers\Api\BoxController');

/*  */
Route::get('{order_date}/ingredients', 'App\Http\Controllers\Api\BoxController@order_ingreients')->name('ordered_ingredients');