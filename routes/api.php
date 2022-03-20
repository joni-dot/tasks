<?php

use App\Http\Controllers\Api\Tasks\CreateTaskController;
use App\Http\Controllers\Api\Tasks\DeleteTaskController;
use App\Http\Controllers\Api\Tasks\GetTasksController;
use App\Http\Controllers\Api\Tasks\ShowTaskController;
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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::redirect('/dashboard', '/tasks')->name('dashboard');

    Route::get('api/tasks', GetTasksController::class)
        ->name('api.tasks.index');

    Route::get('api/tasks/{task}', ShowTaskController::class)
        ->name('api.tasks.show');

    Route::post('api/tasks', CreateTaskController::class)
        ->name('api.tasks.create');

    Route::delete('api/tasks/{task}', DeleteTaskController::class)
        ->name('api.tasks.delete');
});
