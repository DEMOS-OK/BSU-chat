<?php

use App\Http\Controllers\Chat\API\ChatController;
use App\Http\Controllers\Chat\API\MessageController;
use App\Http\Controllers\Chat\API\UserController;
use App\Http\Controllers\Chat\IndexController;
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

Route::get('/', static function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [IndexController::class, 'index'])->name('dashboard');

    Route::middleware('user-in-chat')->prefix('/message')->group(static function () {
        Route::get('/load_more/', [MessageController::class, 'loadMore'])
            ->name('messages.load-more');
        Route::post('/send/', [MessageController::class, 'store'])->name('message.store');
    });

    Route::post('/search-users', [UserController::class, 'search'])->name('search-users');

    Route::prefix('/chat')->group(static function () {
        Route::post('/store', [ChatController::class, 'store'])->name('chat.store');
        Route::post('/update', [ChatController::class, 'update'])->name('chat.update');
        Route::post('/remove-user', [ChatController::class, 'removeUser'])->name('chat.remove-user');
    });
});
