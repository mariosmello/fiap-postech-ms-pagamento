<?php

namespace App\Actions;

use App\Models\Invoice;
use Illuminate\Http\Request;


class CreateInvoice
{
    public function handle(Request $request, array $pix) :Invoice
    {
        $invoice = new \App\Models\Invoice();
        $invoice->status = 'pending';
        $invoice->pix = $pix;
        $invoice->total = $request->get('total');
        $invoice->save();

        $customer = new \App\Models\Customer();
        $customer->id = $request->get('auth')['sub'];
        $customer->name = $request->get('auth')['name'];
        $invoice->customer()->save($customer);

        $order = new \App\Models\Order();
        $order->id = $request->get('order');
        $invoice->order()->save($order);

        return $invoice;
    }

}
