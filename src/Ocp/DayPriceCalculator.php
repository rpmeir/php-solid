<?php

namespace Src\Ocp;

class DayPriceCalculator extends PriceCalculator
{
    public function calculateDuration(
        \DateTimeImmutable $checkinDate,
        \DateTimeImmutable $checkoutDate): int
    {
        $diff = $checkoutDate->diff($checkinDate);
        return (int) $diff->days;
    }
}
