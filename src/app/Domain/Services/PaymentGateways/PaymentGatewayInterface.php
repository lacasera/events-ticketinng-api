<?php

namespace App\Domain\Services\PaymentGateways;

use App\Models\Ticket;

interface PaymentGatewayInterface
{
    public function verify(array $data, Ticket $ticket);
}