<?php

use App\Http\Controllers\API\CreateTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create', [CreateTask::class, 'store'])->name('create');
Route::post('/edit', [CreateTask::class, 'edit_task'])->name('edit_task');
Route::post('/delete/{id}', [CreateTask::class, 'delete_task'])->name('delete_task');
Route::get('/fetchUserID', [CreateTask::class, 'fetchUserID']);