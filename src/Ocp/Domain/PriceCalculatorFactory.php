<?php

declare(strict_types=1);

namespace Src\Ocp\Domain;

use Src\Ocp\Domain\Exception\UnknownPriceCalculatorTypeException;

class PriceCalculatorFactory
{
    public static function create(string $type): PriceCalculator
    {
        return match ($type) {
            'hour' => new HourPriceCalculator(),
            'day' => new DayPriceCalculator(),
            default => throw new UnknownPriceCalculatorTypeException('Unknown price calculator type')
        };
    }
}
