<?php

declare(strict_types=1);

namespace Src\Isp\Infra\Gateway;

use Src\Isp\Application\Dtos\PaymentGatewayInput;
use Src\Isp\Application\Dtos\PaymentGatewayOutput;
use Src\Isp\Application\Gateway\PaymentGateway;

class PaymentGatewayFake implements PaymentGateway
{
    public function __construct()
    {
        // not implemented
    }

    public function processPayment(PaymentGatewayInput $input): PaymentGatewayOutput
    {
        // Simulate a successful payment processing
        $fakeResponse = [
            'tid' => 1234567890,
            'status' => 'approved'
        ];

        // Return the fake response as a PaymentGatewayOutput object
        return new PaymentGatewayOutput($fakeResponse['tid'], $fakeResponse['status']);
    }
}
