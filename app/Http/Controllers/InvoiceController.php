<?php

namespace App\Http\Controllers;

use App\Actions\CreateInvoice;
use App\Http\Requests\CreateInvoiceRequest;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function store(
        CreateInvoiceRequest $request, CreateInvoice $createInvoice)
    {
        $invoice = $createInvoice->handle($request);
        return response()->json($invoice, 201);
    }
}
