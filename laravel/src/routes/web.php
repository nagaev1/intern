<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/create', [PostController::class,'create'])->name('posts.create');
Route::post('/posts', [PostController::class,'store'])->name('posts.store');