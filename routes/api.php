<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Webhook\MlPixController;

Route::post('webhook/ml/pix', [MlPixController::class, 'update']);
