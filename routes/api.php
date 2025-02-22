<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\DialogflowController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::get('/dialogflow', [DialogflowController::class, 'status']);
Route::post('/dialogflow', [DialogflowController::class, 'handleWebhook']);