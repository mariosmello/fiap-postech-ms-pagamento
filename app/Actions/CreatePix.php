<?php

namespace App\Actions;

use Illuminate\Http\Request;


class CreatePix
{
    public function handle() :array
    {
        /**
         * Integração Fake com método de pagamento
         */
        return [
            'qrcode_url' => 'https://upload.wikimedia.org/wikipedia/commons/4/41/QR_Code_Example.svg',
            'code' => '00020126330014BR.GOV.BCB.PIX0111343609248795204000053039865406100.005802BR5911Mario Mello6011Santo Andre62060502id6304D612'
        ];
    }

}
