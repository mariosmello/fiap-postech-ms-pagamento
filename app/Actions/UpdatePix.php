<?php

namespace App\Actions;

use App\Jobs\InvoicePaid;
use App\Jobs\ProcessWebhookStatus;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class UpdatePix
{
    public function handle(array $data) :void
    {
        $invoice = Invoice::where("_id", $data['invoice'])->firstOrFail();
        $invoice->status = $data['status'];
        $invoice->save();

        InvoicePaid::dispatch($invoice)->delay(5)->onQueue('order_updates');
    }

}
