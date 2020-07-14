<?php

namespace App\Domain\Services\PaymentGateways\Actions\Flutterwave;

use Illuminate\Support\Facades\Http;

class VerifyPaymentAction
{
    protected $endpoint;

    public function __construct()
    {
        $this->endpoint = config('flutterwave.endpoint'). "/flwv3-pug/getpaidx/api/v2/verify";
    }

    public function execute($data)
    {
        $response = Http::asJson()->post($this->endpoint, $data)->json();

        return $response['status'] == 'success' ? $response['data'] : null;
    }
}