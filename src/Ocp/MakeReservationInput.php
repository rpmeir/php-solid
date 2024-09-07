<?php

namespace Src\Ocp;

class MakeReservationInput
{
    public function __construct(
        public readonly string $roomId,
        public readonly string $email,
        public readonly \DateTimeImmutable $checkinDate,
        public readonly \DateTimeImmutable $checkoutDate
    ) {}
}
