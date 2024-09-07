<?php

namespace Src\Ocp;

use Src\DatabaseConnection;

class ReservationRepositoryDatabase implements ReservationRepository
{
    public function __construct(public readonly DatabaseConnection $databaseConnection) {}

    public function save(Reservation $reservation): void
    {
        $this->databaseConnection->query(
            'INSERT INTO ocp.reservations (reservation_id, room_id, email, checkin_date, checkout_date, duration, price, status)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
            [
                $reservation->reservationId,
                $reservation->roomId,
                $reservation->email,
                $reservation->checkinDate->format('Y-m-d H:i:s'),
                $reservation->checkoutDate->format('Y-m-d H:i:s'),
                $reservation->getDuration(),
                $reservation->getPrice(),
                $reservation->getStatus()
            ]
        );
    }

    public function get(string $reservationId): Reservation
    {
        [$reservation] = $this->databaseConnection->query(
            'SELECT * FROM ocp.reservations WHERE reservation_id = ?',
            [$reservationId]
        );
        return new Reservation(
            (string) $reservation['reservation_id'],
            (string) $reservation['room_id'],
            (string) $reservation['email'],
            new \DateTimeImmutable((string) $reservation['checkin_date']),
            new \DateTimeImmutable((string) $reservation['checkout_date']),
            (int) $reservation['duration'],
            (float) $reservation['price'],
            (string) $reservation['status']
        );
    }
}
