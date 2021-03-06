<?php

use App\Http\Controllers\Web\Tasks\DeleteTaskController;
use App\Http\Controllers\Web\Tasks\ListTasksController;
use App\Http\Controllers\Web\Tasks\StoreTaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::redirect('/dashboard', '/tasks')->name('dashboard');

    Route::get('/tasks', ListTasksController::class)
        ->name('tasks.index');

    Route::post('/tasks', StoreTaskController::class)
        ->name('tasks.store');

    Route::delete('/tasks/{task}', DeleteTaskController::class)
        ->name('tasks.delete');
});
