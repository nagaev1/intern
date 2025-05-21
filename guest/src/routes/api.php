<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;

Route::apiResource("/records", RecordController::class);