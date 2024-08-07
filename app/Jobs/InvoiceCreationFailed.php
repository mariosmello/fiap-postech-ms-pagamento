<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InvoiceCreationFailed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $order_code;

    public string $exception;

    /**
     * Create a new job instance.
     */
    public function __construct(string $order_code, string $exception)
    {
        $this->order_code = $order_code;
        $this->exception = $exception;
    }

    public function handle(): void
    {
    }
}
