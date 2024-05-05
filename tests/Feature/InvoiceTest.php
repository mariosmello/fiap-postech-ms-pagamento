<?php

uses(\Illuminate\Foundation\Testing\DatabaseMigrations::class);

beforeEach(function () {
    $this->token = \Firebase\JWT\JWT::encode([
        'sub' => '1',
        'name' => fake()->name(),
        'email' => fake()->email(),
    ], env('JWT_SECRET'), 'HS256');
});

it('can create a invoice', function () {

    $data = [
        'order' => '1234',
        'total' => 100.20,
    ];

    // 201 http created
    $this->postJson('/api/invoices', $data, [
        'Authorization' => 'Bearer ' . $this->token
    ])->assertStatus(201);

});
