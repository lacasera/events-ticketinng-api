<?php

namespace App\Domain\Services\PaymentGateways\Actions\Flutterwave;

use Illuminate\Support\Facades\Http;

class VerifyPaymentAction
{
    protected $endpoint;

    public function __construct()
    {
        $this->endpoint = app()->environment('production') 
            ? "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify"
            : "https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/v2/verify";
    }

    public function execute($data)
    {
        $response = Http::asJson()->post($this->endpoint, $data)->json();

        return $response['status'] == 'success' ? $response['data'] : null;
    }
}