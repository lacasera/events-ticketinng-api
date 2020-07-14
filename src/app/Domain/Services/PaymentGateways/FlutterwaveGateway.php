<?php

namespace App\Domain\Services\PaymentGateways;

use App\Domain\Services\PaymentGateways\Actions\Flutterwave\VerifyPaymentAction;
use App\Models\PaymentAccount;

class FlutterwaveGateway implements PaymentGatewayInterface
{

    public function verify(array $data, $ticket)
    {
        $paymentAccount = $ticket->payment_account_id ? PaymentAccount::find($ticket->payment_account_id)->makeVisible('secret_key') : (object) config('ticketinn.payment');

        return app(VerifyPaymentAction::class)->execute([
            'txref' => $data['txref'],
            'SECKEY' => $paymentAccount->secret_key
        ]);
    }
}