<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\ApiInfoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TaskController;

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

Route::get('sign-in', [AuthController::class, 'signinView'])->name('signin.view');
Route::post('sign-in', [AuthController::class, 'signin'])->name('signin');

Route::get('sign-up', [AuthController::class, 'signupView'])->name('signup.view');
Route::post('sign-up', [AuthController::class, 'signup'])->name('signup');

// Admin After Login
Route::middleware('auth.admin:administrators')->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::post('/sign-out', [AuthController::class, 'signout'])->name('signout');

    Route::prefix('/api-info')->group(function () {
        Route::get('/list', [ApiInfoController::class, 'list'])->name('api-info.list');
        Route::get('/detail', [ApiInfoController::class, 'detail'])->name('api-info.detail');
    });

    Route::prefix('items')->group(function () {
        Route::get('/list', [ItemController::class, 'list'])->name('item.list');
        Route::get('/new', [ItemController::class, 'new'])->name('item.new');
        Route::post('/store', [ItemController::class, 'store'])->name('item.store');
        Route::get('/{id}', [ItemController::class, 'edit'])->name('item.edit');
        Route::post('/update/{id}', [ItemController::class, 'update'])->name('item.update');
        Route::post('/delete/{id}', [ItemController::class, 'delete'])->name('item.delete');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/list', [OrderController::class, 'list'])->name('order.list');
        Route::post('/csv-upload', [OrderController::class, 'csvUpload'])->name('order.csv-upload');
        Route::post('/task-output', [OrderController::class, 'taskOutput'])->name('order.task-output');
        // order edit / update / delete は未実装（ルーティングのみ通しています）
        Route::get('/{id}', [OrderController::class, 'edit'])->name('order.edit');
        Route::post('/update/{id}', [OrderController::class, 'update'])->name('order.update');
        Route::post('/delete/{id}', [OrderController::class, 'delete'])->name('order.delete');
    });

    Route::prefix('tasks')->group(function () {
        Route::get('/list', [TaskController::class, 'list'])->name('task.list');
        Route::post('/completion-report', [TaskController::class, 'completionReport'])->name('task.completion-report');
        Route::get('/list-completed', [TaskController::class, 'list'])->name('task.list-completed');
        // task edit / update / delete は未実装（ルーティングのみ通しています）
        Route::get('{id}', [TaskController::class, 'edit'])->name('task.edit');
        Route::post('/update/{id}', [TaskController::class, 'update'])->name('task.update');
        Route::post('/delete/{id}', [TaskController::class, 'delete'])->name('task.delete');
    });

    // profile edit
    Route::prefix('/profile')->group(function () {
        // Route::get('/password-edit', [Admin\ProfileController::class, 'passwordView'])->name('password.view');
        // Route::post('/password-edit' [Admin\ProfileController::class, 'passwordConfirm'])->name('password.confirm);
        // Route::post('/password-update' [Admin\ProfileController::class, 'passwordUpdate'])->name('password.update);
        // Route::get('/edit', [Admin\ProfileController::class, 'editProfileView'])->name('profile.view');
        // Route::post('/edit' [Admin\ProfileController::class, 'profileConfirm'])->name('profile.confirm);
        // Route::post('/update' [Admin\ProfileController::class, 'profileUpdate'])->name('profile.update);
    });
});
