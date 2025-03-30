<?php

declare(strict_types=1);

namespace Src\Isp\Application\Dtos;

class CheckoutInput
{
    public function __construct(
        public readonly string $email,
        public readonly string $creditCardToken,
        public readonly array $items = []
    ) {
    }
}
