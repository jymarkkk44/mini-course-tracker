<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::delete('/courses/{course}', [CourseController::class, 'destroy']);
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');

Route::post('/topics', [TopicController::class, 'store']);
Route::delete('/topics/{topic}', [TopicController::class, 'destroy']);
Route::get('/topics/{topic}/edit', [TopicController::class, 'edit'])->name('topics.edit');
Route::put('/topics/{topic}', [TopicController::class, 'update'])->name('topics.update');
