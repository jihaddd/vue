<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Invntory;
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

Route::post('register', [Invntory::class, 'register']);
Route::post('login', [Invntory::class, 'login']);
Route::post('login/emloyee', [Invntory::class,'login_employee']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('book', Invntory::class);
    Route::post('register/emloyee', [Invntory::class,'register_employee']);

    Route::get('delete/emloyee/{id}', [Invntory::class,'delete_employee']);

    Route::post('update/book/{id}', [Invntory::class,'update_book']);
    
});

