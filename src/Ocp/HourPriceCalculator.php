<?php

namespace Src\Ocp;

class HourPriceCalculator extends PriceCalculator
{
    public function calculateDuration(
        \DateTimeImmutable $checkinDate,
        \DateTimeImmutable $checkoutDate): int
    {
        $diff = $checkoutDate->diff($checkinDate);
        return $diff->h;
    }
}
