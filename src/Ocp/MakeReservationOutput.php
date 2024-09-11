<?php

declare(strict_types=1);

namespace Src\Ocp;

class MakeReservationOutput
{
    public function __construct(public readonly string $reservationId)
    {
    }
}
