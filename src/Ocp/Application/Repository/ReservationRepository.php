<?php

declare(strict_types=1);

namespace Src\Ocp\Application\Repository;

use Src\Ocp\Domain\Reservation;

interface ReservationRepository
{
    public function save(Reservation $reservation): void;
    public function get(string $reservationId): Reservation;
}
