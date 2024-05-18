<?php

use Illuminate\Support\Facades\Queue;

uses(\Illuminate\Foundation\Testing\DatabaseMigrations::class);

it('cant create a webhook update with invalid request', function () {
    $this->postJson('/api/webhook/ml/pix', [])->assertStatus(422);
});

it('cat create a webhook update with invalid request', function () {

    Queue::fake();

    $invoice = new \App\Models\Invoice();
    $invoice->status = 'pending';
    $invoice->save();

    $order = new \App\Models\Order();
    $order->id = "123";
    $invoice->order()->save($order);

    $this->postJson('/api/webhook/ml/pix', [
        'invoice' => $invoice->getIdAttribute(),
        'status' => 'paid'
    ])->assertStatus(200);
});
