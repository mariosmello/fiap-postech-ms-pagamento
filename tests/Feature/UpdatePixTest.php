<?php

use Illuminate\Support\Facades\Queue;

uses(\Illuminate\Foundation\Testing\DatabaseMigrations::class);

it('can update a pix payment invoice', function () {

    Queue::fake();

    $invoice = new \App\Models\Invoice();
    $invoice->status = 'pending';
    $invoice->save();

    $order = new \App\Models\Order();
    $order->id = "123";
    $invoice->order()->save($order);

    $updatePix = new \App\Actions\UpdatePix();
    $updatePix->handle([
        'invoice' => $invoice->getIdAttribute(),
        'status' => 'paid'
    ]);

    Queue::assertPushedOn('payments', \App\Jobs\ProcessWebhookStatus::class);

    $invoice = \App\Models\Invoice::where('_id',$invoice->getIdAttribute())->firstOrFail();
    expect($invoice->status)->toBe('paid');

});
