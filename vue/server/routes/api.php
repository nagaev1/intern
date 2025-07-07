<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/posts/{user:name}', [PostController::class, 'postsUser'])->name('posts.user');
Route::get('/posts/hash/{hashtag:name}', [PostController::class, 'postsHashtag'])->name('posts.hashtag');

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/user/{userId}/subscribe', [PostController::class, 'switchSubscription'])->name('users.subscribe');

    Route::get('/feed', [PostController::class, 'feed'])->name('posts.feed');
    Route::get('/subscriptions', [PostController::class, 'subscriptionList']);
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
