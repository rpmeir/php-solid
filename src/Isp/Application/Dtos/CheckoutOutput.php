<?php

declare(strict_types=1);

namespace Src\Isp\Application\Dtos;

class CheckoutOutput
{
    public function __construct(
        public readonly string $orderId
    ) {
    }
}
