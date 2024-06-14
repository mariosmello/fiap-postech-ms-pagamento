<?php

namespace App\Actions;

use App\Jobs\InvoicePaid;
use App\Jobs\InvoicePaymentFailed;
use App\Models\Invoice;

class UpdatePix
{
    public function handle(array $data) :void
    {
        $invoice = Invoice::where("_id", $data['invoice'])->firstOrFail();
        $invoice->status = $data['status'];
        $invoice->save();

        if ('paid' === $data['status']) {
            InvoicePaid::dispatch($invoice)
                ->delay(5)
                ->onQueue('order_updates');
        } else {
            InvoicePaymentFailed::dispatch($invoice)
                ->delay(5)
                ->onQueue('order_updates');
        }

    }

}
