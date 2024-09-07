<?php

namespace Src\Ocp;

class PriceCalculatorOutput
{
    public function __construct(
        public readonly int $duration,
        public readonly float $price
    ) {}
}
