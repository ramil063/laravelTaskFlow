<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::apiResource('project', ProjectController::class);
