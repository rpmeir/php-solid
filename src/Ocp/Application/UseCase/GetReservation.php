<?php

declare(strict_types=1);

namespace Src\Ocp\Application\UseCase;

use Src\Ocp\Application\Repository\ReservationRepository;
use Src\Ocp\Domain\Reservation;

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
