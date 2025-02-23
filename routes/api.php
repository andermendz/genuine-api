<?php

use App\Http\Controllers\DialogflowController;
use Illuminate\Support\Facades\Route;

Route::get('/dialogflow/status', [DialogflowController::class, 'status']);
Route::post('/dialogflow/webhook', [DialogflowController::class, 'handleWebhook']);