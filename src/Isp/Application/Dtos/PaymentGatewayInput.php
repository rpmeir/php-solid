<?php

declare(strict_types=1);

namespace Src\Isp\Application\Dtos;

class PaymentGatewayInput
{
    public function __construct(
        public readonly string $creditCardToken,
        public readonly float $amount
    ) {
    }
}
