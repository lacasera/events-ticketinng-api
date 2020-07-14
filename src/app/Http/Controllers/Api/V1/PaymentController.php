<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Ticket;
use App\Events\PaymentConfirmed;
use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseTicketRequest;
use App\Exceptions\UnableToVerifyPaymentException;
use App\Domain\Services\PaymentGateways\GatewayFactory;

class PaymentController extends Controller
{
    
    public function buy(PurchaseTicketRequest $request, Ticket $ticket, GatewayFactory $gatewayFactory)
    {
        $transactionDetails = $gatewayFactory
            ->make($request->gateway)
            ->verify($request->except('gateway'), $ticket);
  
        throw_if(
            !$transactionDetails, 
            new UnableToVerifyPaymentException(
                "No transaction with the reference $request->txref was found with $request->gateway"
            )
        );

        event(new PaymentConfirmed($request->all(), $transactionDetails, $ticket));

       return response()->json(['data' => 'payment confirmed successfully.. ticket is being generated'], 200);
    }
}
