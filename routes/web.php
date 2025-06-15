<?php

use App\Http\Controllers\TopicController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::post('/topics', [TopicController::class, 'store']);
Route::delete('/courses/{course}', [CourseController::class, 'destroy']);
Route::delete('/topics/{topic}', [TopicController::class, 'destroy']);
Route::get('/courses/{course}/edit', [CourseController::class, 'edit']);
Route::put('/courses/{course}', [CourseController::class, 'update']);
Route::get('/topics/{topic}/edit', [TopicController::class, 'edit']);
Route::put('/topics/{topic}', [TopicController::class, 'update']);
