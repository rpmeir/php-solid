<?php

declare(strict_types=1);

namespace Src\Ocp;

class PriceCalculatorOutput
{
    public function __construct(
        public readonly int $duration,
        public readonly float $price
    ) {
    }
}
