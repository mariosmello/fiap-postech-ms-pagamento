<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use \App\Http\Controllers\Webhook\MlPixController;

Route::middleware(\App\Http\Middleware\EnsureTokenIsValid::class)->group(function () {
    Route::apiResource('invoices', InvoiceController::class);
});

Route::post('webhook/ml/pix', [MlPixController::class, 'update']);
