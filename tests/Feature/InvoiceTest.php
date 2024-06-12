<?php

use Illuminate\Support\Facades\Queue;

uses(\Illuminate\Foundation\Testing\DatabaseMigrations::class);

it('can create a invoice', function () {

    $data = [
        'order' => '1234',
        'total' => 100.20,
        'customer_id' => 1,
        'customer_name' => fake()->name()
    ];

    \App\Jobs\OrderCreated::dispatch($data)->onQueue('payment_updates');

    $invoice = \App\Models\Invoice::where('order', $data['order'])->first();
    expect($invoice->count())->toBe(1);


});
