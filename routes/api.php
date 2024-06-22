<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'create']);
Route::get('/students/{id}', [StudentController::class, 'student']);
Route::patch('/students/{id}', [StudentController::class, 'update']);

Route::get('/students/{id}/subjects', [SubjectController::class, 'index']);
Route::post('/students/{id}/subjects', [SubjectController::class, 'create_subject']);
Route::get('/students/{id}/subjects/{subject_id}', [SubjectController::class, 'subject']);
Route::patch('/students/{id}/subjects/{subject_id}', [SubjectController::class, 'update_subject']);
