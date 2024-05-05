<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

Route::middleware(\App\Http\Middleware\EnsureTokenIsValid::class)->group(function () {
    Route::apiResource('invoices', InvoiceController::class);
});

//Route::post('webhook/ml/pix', InvoiceController::class);

