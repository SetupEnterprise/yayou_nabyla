<?php

use App\Http\Controllers\StatistiqueController;
use App\Http\Middleware\ConnectionSession;
use App\models\Modele;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Input\Input;

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

Route::get('/', 'StatistiqueController@login')->name('login');

Route::post('/', 'StatistiqueController@login_store')->name('login_store');

Route::get('/gerant/dashboard','StatistiqueController@index')->name('gerant.dashboard')->middleware(ConnectionSession::class);

Route::resource('gerant', 'GerantController')->middleware(ConnectionSession::class);

Route::resource('automobile','AutomobileController')->middleware(ConnectionSession::class);

Route::post('automobile/store','AutomobileController@store')->middleware(ConnectionSession::class);

Route::get('/getMarques', 'AutomobileController@getMarques')->middleware(ConnectionSession::class);

Route::get('/getModelesMarque/{id}', 'AutomobileController@getModelesMarque')->middleware(ConnectionSession::class);

Route::resource('marque', 'MarqueController')->middleware(ConnectionSession::class);

Route::resource('modele', 'ModeleController')->middleware(ConnectionSession::class);

Route::get('/disconnect', 'StatistiqueController@disconnect')->name('gerant_disconnect');

Route::get('/line','DashbordController@getDonneesAutoMensuels');
Route::get('/pie','DashbordController@getStatusVente');
