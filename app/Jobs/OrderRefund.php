<?php

namespace App\Jobs;

use App\Actions\CreateInvoice;
use App\Actions\CreatePix;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OrderRefund implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    public function __construct($order) {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $invoice = Invoice::where("order", $this->order['order'])->firstOrFail();
        $invoice->status = 'refunded';
        $invoice->save();

        Log::warning('Refund', [
            'order' => $this->order['order'],
            'status' => 'refunded',
        ]);

        OrderRefunded::dispatch([
            'order' => $this->order['order'],
            'status' => 'refunded',
        ])->onQueue('order_updates')
            ->delay(5);
    }
}
