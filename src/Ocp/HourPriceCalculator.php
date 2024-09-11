<?php

declare(strict_types=1);

namespace Src\Ocp;

class HourPriceCalculator extends PriceCalculator
{
    public function calculateDuration(
        \DateTimeImmutable $checkinDate,
        \DateTimeImmutable $checkoutDate
    ): int {
        $diff = $checkoutDate->diff($checkinDate);
        return $diff->h;
    }
}
