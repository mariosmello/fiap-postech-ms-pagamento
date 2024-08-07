<?php

namespace App\Jobs;

use App\Actions\CreateInvoice;
use App\Actions\CreatePix;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    public function __construct($order) {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(CreatePix $createPix, CreateInvoice $createInvoice): void
    {

        try {

            $pix = $createPix->handle();
            $invoice = $createInvoice->handle($this->order, $pix);

            InvoiceCreated::dispatch([
                'id' => $invoice->getIdAttribute(),
                'pix' => $invoice->pix,
                'order' => $this->order['order'],
            ])->onQueue('order_updates')
                ->delay(5);

        } catch (\Exception $exception) {

            InvoiceCreationFailed::dispatch(
                $this->order['order'],
                $exception->getMessage()
            )->onQueue('order_updates')
                ->delay(5);

        }

    }
}
