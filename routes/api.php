<?php

use App\Http\Controllers\comment;
use App\Http\Controllers\courses;
use App\Http\Controllers\lessons;
use App\Http\Controllers\question;
use App\Http\Controllers\regis;
use App\Http\Controllers\topics;
use App\Http\Controllers\users;
use App\Http\Controllers\blogs;
use App\Models\a_tests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/auth', [users::class, 'user']);
Route::post('/auth', [users::class, 'login']);
Route::delete('/auth', [users::class, 'logout']);


Route::apiResource('/courses', courses::class);
Route::apiResource('/cmt', comment::class);
Route::apiResource('/topics', topics::class);
Route::apiResource('/lessons', lessons::class);
Route::apiResource('/questions', question::class);
Route::apiResource('/blogs', blogs::class);

Route::post('/code',[question::class, 'test']);
Route::get('/test', function(){
    return a_tests::all();
});

Route::post('/lessons/change',[lessons::class,'change']);
Route::get('/lessons/proccess/{id}', [lessons::class, 'checkpro']);
Route::post('/regis/{id}', [regis::class, 'regis']);
Route::post('/evaluate/{id}', [regis::class, 'evaluate']);

Route::post('/lessons/like', [lessons::class, 'like']);
Route::post('/lessons/unlike', [lessons::class, 'unlike']);
Route::post('/topics/like', [topics::class, 'like']);
Route::post('/topics/unlike', [topics::class, 'unlike']);
Route::post('/blogs/like', [blogs::class, 'like']);
Route::post('/blogs/unlike', [blogs::class, 'unlike']);
Route::get('/blogs/view/{id}',[blogs::class, 'view']);