<?php

declare(strict_types=1);

namespace Src\Isp\Domain;

class Product
{
    public function __construct(
        public readonly string $productId,
        public readonly string $description,
        public readonly float $price
    ) {
    }
}
