<?php

use App\Http\Controllers\courses;
use App\Http\Controllers\lessons;
use App\Http\Controllers\main;
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
Route::get('/courses/regis/{id}', [courses::class, 'regis']);
Route::apiResource('/lessons', lessons::class);

Route::post('/lessons/change',[lessons::class,'change']);

Route::get('/menu', [main::class, 'menu']);