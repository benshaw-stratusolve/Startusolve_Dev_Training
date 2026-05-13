<?php

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Models\Idea;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionsController;

Route::get('/', function () {
    return 'Welcome to the home page';
});

Route::get('/ideas/create', [IdeaController::class, 'create'])->middleware('auth');
Route::get('/ideas/{idea}', [IdeaController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas.index');
    Route::post('/ideas', [IdeaController::class, 'store']);
    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->can('update', 'idea');
    Route::patch('/ideas/{idea}', [IdeaController::class, 'update']);
    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy']);
    Route::delete('/logout', [SessionsController::class, 'destroy']);
});

Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);
});

Route::get('/admin', function () {
    Gate::authorize('view-admin');

    return 'Private admin only area';
});