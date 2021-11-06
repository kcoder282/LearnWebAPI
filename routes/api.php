<?php

use App\Http\Controllers\courses;
use App\Http\Controllers\lessons;
use App\Http\Controllers\users;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/auth', [users::class, 'user']);
Route::post('/auth', [users::class, 'login']);
Route::delete('/auth', [users::class, 'logout']);


Route::apiResource('/courses', courses::class);
Route::get('/courses/regis/{id}', [courses::class, 'regis']);
Route::apiResource('/lessons', lessons::class);

Route::post('/lessons/change',[lessons::class,'change']);

Route::get('/auth', [users::class, 'user']);