<?php

use App\Http\Controllers\DialogflowController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});