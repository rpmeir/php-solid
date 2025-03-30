<?php

declare(strict_types=1);

namespace Src\Isp\Application\Dtos;

class CurrencyOutput
{
    public function __construct(
        public readonly float $value
    ) {
    }
}
