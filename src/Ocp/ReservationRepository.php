<?php

namespace Src\Ocp;

interface ReservationRepository
{
    public function save(Reservation $reservation): void;
    public function get(string $reservationId): Reservation;
}
