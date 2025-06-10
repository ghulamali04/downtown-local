<?php

use App\Http\Controllers\PrintController;
use Illuminate\Support\Facades\Route;

Route::post('/open/print/receipt', [PrintController::class, 'printReceipt']);
