<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});


#Route::post('/register', [AuthController::class, 'register']);
Route::post('/api/test', [UserController::class, 'test_json']);
Route::post('/api/register', [UserController::class, 'register']);
Route::post('/api/test_data', [UserController::class, 'test_data']);