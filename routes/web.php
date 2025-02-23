<?php

use App\Http\Controllers\DialogflowController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/data', function () {
    return Category::with('products')->get();
});