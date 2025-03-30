<?php

declare(strict_types=1);

namespace Src\Isp\Application\Dtos;

class PaymentGatewayOutput
{
    public function __construct(
        public readonly int $tid,
        public readonly string $status
    ) {
    }
}
