<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DemoController;

Route::get('/first',[DemoController::class,'first_demo']);
Route::get('/signup',[DemoController::class,'signup_form']);
Route::post('/submit',[DemoController::class,'submit_form']);
Route::get('/display',[DemoController::class,'display']);
Route::get('/edit{edit_id}',[DemoController::class,'edit_form']);
Route::post('/update',[DemoController::class,'update']);
Route::get('/delete{dlt_id}',[DemoController::class,'delete']);