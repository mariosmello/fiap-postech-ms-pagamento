<?php

use Illuminate\Support\Facades\Queue;

uses(\Illuminate\Foundation\Testing\DatabaseMigrations::class);

it('can create an invoice', function () {

    $data = [
        'order' => '1234',
        'total' => 100.20,
        'customer_id' => 1,
        'customer_name' => fake()->name()
    ];

    \App\Jobs\OrderCreated::dispatch($data)->onQueue('payment_updates');

    $invoice = \App\Models\Invoice::where('order', $data['order'])->get();
    expect($invoice->count())->toBe(1);

});


it('cant create a duplicated invoice', function () {

    $data = [
        'order' => '1234',
        'total' => 100.20,
        'customer_id' => 1,
        'customer_name' => fake()->name()
    ];

    \App\Jobs\OrderCreated::dispatch($data)->onQueue('payment_updates');

    $data2 = [
        'order' => '4567',
        'total' => 100.20,
        'customer_id' => 1,
        'customer_name' => fake()->name()
    ];
    \App\Jobs\OrderCreated::dispatch($data2)->onQueue('payment_updates');

    $invoice = \App\Models\Invoice::where('order', $data2['order'])->get();
    expect($invoice->count())->toBe(0);



});
