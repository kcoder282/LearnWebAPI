<?php

use App\Http\Controllers\courses;
use App\Http\Controllers\lessons;
use App\Http\Controllers\regis;
use App\Http\Controllers\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/auth', [users::class, 'user']);
Route::post('/auth', [users::class, 'login']);
Route::delete('/auth', [users::class, 'logout']);


Route::apiResource('/courses', courses::class);
Route::apiResource('/lessons', lessons::class);

Route::post('/lessons/change',[lessons::class,'change']);
Route::post('/lessons/like', [lessons::class, 'like']);
Route::post('/lessons/unlike', [lessons::class, 'unlike']);
Route::post('/regis/{id}', [regis::class, 'regis']);
Route::post('/evaluate/{id}', [regis::class, 'evaluate']);