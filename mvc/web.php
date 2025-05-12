<?php

use App\Core\Route;
use App\Controllers\{HomeController, PostController};

Route::get('/', [HomeController::class, 'index']);
Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::ErrorPage404();