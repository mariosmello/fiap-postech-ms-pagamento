<?php

namespace App\Http\Controllers;

use App\Actions\CreateInvoice;
use App\Actions\CreatePix;
use App\Http\Requests\CreateInvoiceRequest;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function store(
        CreateInvoiceRequest $request, CreatePix $createPix, CreateInvoice $createInvoice)
    {
        $pix = $createPix->handle();
        $invoice = $createInvoice->handle($request, $pix);
        return response()->json($invoice, 201);
    }
}
