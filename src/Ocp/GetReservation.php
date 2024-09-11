<?php

declare(strict_types=1);

namespace Src\Ocp;

class GetReservation
{
    public function __construct(
        private readonly ReservationRepository $reservationRepository
    ) {
    }

    public function execute(string $reservationId): Reservation
    {
        return $this->reservationRepository->get($reservationId);
    }
}
