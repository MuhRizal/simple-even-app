<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

Route::group(['middleware' => ['web']], function () {
	Auth::routes();
    Route::get('/', [EventController::class, 'index']);
});


Route::group(['middleware' => ['auth']], function () {
	Route::get('/logout', function () {
		Auth::logout();
		return redirect('/login');
	})->name("logout");	
   
	//-- events
	Route::get('/events', [EventController::class, 'index']);
	Route::get('/event/{id}', [EventController::class, 'show']);
	Route::post('/event', [EventController::class, 'store']);
	Route::put('/event_confirmation', [EventController::class, 'event_confirmation']);
	Route::get('/datatable/events', [EventController::class, 'events_table']);
});
