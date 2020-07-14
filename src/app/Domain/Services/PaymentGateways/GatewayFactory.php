<?php

namespace App\Domain\Services\PaymentGateways;

use Exception;

class GatewayFactory
{
    public function make(string $name): PaymentGatewayInterface
    {
        $class = __NAMESPACE__."\\".ucfirst($name)."Gateway";
        throw_if(!class_exists($class), new Exception("$class not found"));

        return app()->make($class);
    }
}