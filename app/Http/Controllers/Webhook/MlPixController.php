<?php

namespace App\Http\Controllers\Webhook;

use App\Actions\UpdatePix;
use App\Http\Controllers\Controller;
use App\Http\Requests\WebhookUpdatePixRequest;


class MlPixController extends Controller
{
    public function update(
        WebhookUpdatePixRequest $request, UpdatePix $updatePix)
    {
        $updatePix->handle($request->validated());
        return response()->json([], 200);

    }
}
