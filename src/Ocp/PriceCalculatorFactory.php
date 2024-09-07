<?php

namespace Src\Ocp;

class PriceCalculatorFactory
{
    public static function create (string $type): PriceCalculator
    {
        return match ($type) {
            'hour' => new HourPriceCalculator(),
            'day' => new DayPriceCalculator(),
            default => throw new UnknownPriceCalculatorTypeException('Unknown price calculator type')
        };
    }
}
