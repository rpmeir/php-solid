<?php

declare(strict_types=1);

namespace Src\Isp\Application\Gateway;

use Src\Isp\Application\Dtos\PaymentGatewayInput;
use Src\Isp\Application\Dtos\PaymentGatewayOutput;

interface PaymentGatewayCheckout
{
    public function processPayment(PaymentGatewayInput $input): PaymentGatewayOutput;
}
