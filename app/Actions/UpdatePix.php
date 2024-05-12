<?php

namespace App\Actions;

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

        ProcessWebhookStatus::dispatch($invoice)->delay(2)->onQueue('payments');
    }

}
