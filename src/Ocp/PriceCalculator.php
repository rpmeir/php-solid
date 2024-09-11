<?php

declare(strict_types=1);

namespace Src\Ocp;

abstract class PriceCalculator
{
    public function calculate(
        \DateTimeImmutable $checkinDate,
        \DateTimeImmutable $checkoutDate,
        float $roomPrice
    ): PriceCalculatorOutput {
        $duration = $this->calculateDuration($checkinDate, $checkoutDate);
        $price = $roomPrice * $duration;
        return new PriceCalculatorOutput(
            $duration,
            $price
        );
    }

    abstract public function calculateDuration(
        \DateTimeImmutable $checkinDate,
        \DateTimeImmutable $checkoutDate
    ): int;
}
