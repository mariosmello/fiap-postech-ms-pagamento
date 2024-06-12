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
        $invoice->save();

        $customer = new \App\Models\Customer();
        $customer->id = $order['customer_id'];
        $customer->name = $order['customer_name'];
        $invoice->customer()->save($customer);

        $order = new \App\Models\Order();
        $order->id = $order['order'];
        $invoice->order()->save($order);

        return $invoice;
    }

}
