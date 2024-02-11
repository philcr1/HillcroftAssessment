<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inventory', [InventoryController::class, 'loadInventory']);

Route::post('/products', [ProductController::class, 'importProducts']);