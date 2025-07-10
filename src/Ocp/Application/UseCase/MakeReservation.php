<?php

declare(strict_types=1);

namespace Src\Ocp\Application\UseCase;

use Src\Ocp\Application\Dtos\MakeReservationInput;
use Src\Ocp\Application\Dtos\MakeReservationOutput;
use Src\Ocp\Application\Repository\ReservationRepository;
use Src\Ocp\Application\Repository\RoomRepository;
use Src\Ocp\Domain\Reservation;

class MakeReservation
{
    public function __construct(
        private readonly RoomRepository $roomRepository,
        private readonly ReservationRepository $reservationRepository
    ) {
    }

    public function execute(MakeReservationInput $input): MakeReservationOutput
    {
        $room = $this->roomRepository->get($input->roomId);
        $reservation = Reservation::create(
            $input->roomId,
            $input->email,
            $input->checkinDate,
            $input->checkoutDate
        );
        $reservation->calculate($room);
        $this->reservationRepository->save($reservation);
        return new MakeReservationOutput($reservation->reservationId);
    }
}
