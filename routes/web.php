<?php

use App\Http\Controllers\StatistiqueController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/layouts/welcome');
});
Route::get('/gerant/dashboard','StatistiqueController@index')->name('gerant.dashboard');
Route::resource('gerant', 'GerantController');

Route::resource('automobile','AutomobileController');
