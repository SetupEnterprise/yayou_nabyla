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

//Afficher la liste des véhicules
Route::get('automobiles', 'ReactAutomobileController@index');
Route::get('trie_par_prix', 'ReactAutomobileController@trie_par_prix');
Route::get('getPriorite/{priorite}', 'ReactAutomobileController@getPriorite');
Route::get('filterBy/{nom}', 'ReactAutomobileController@filterBy');
