<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/', [PostController::class, 'store']);
        Route::get('/{postId}', [PostController::class, 'show'])->name('posts.show');
        Route::get('/{postId}/edit', [PostController::class, 'edit'])->name(
            'posts.edit'
        );
        Route::put('/{postId}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{postId}', [PostController::class, 'destroy'])->name(
            'posts.destroy'
        );
    });

    Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{commentId}', [CommentController::class, 'destroy'])->name('comments.destroy');
});


require __DIR__.'/auth.php';
