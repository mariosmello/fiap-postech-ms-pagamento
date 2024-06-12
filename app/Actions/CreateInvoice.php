<?php

namespace App\Actions;

use App\Models\Invoice;

class CreateInvoice
{
    public function handle(array $order, array $pix) :Invoice
    {
        $invoice = new \App\Models\Invoice();
        $invoice->status = 'pending';
        $invoice->pix = $pix;
        $invoice->total = $order['total'];
        $invoice->order = $order['order'];
        $invoice->save();

        $customer = new \App\Models\Customer();
        $customer->id = $order['customer_id'];
        $customer->name = $order['customer_name'];
        $invoice->customer()->save($customer);

        return $invoice;
    }

}
