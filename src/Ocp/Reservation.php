<?php

declare(strict_types=1);

namespace Src\Ocp;

use Ramsey\Uuid\Uuid;

class Reservation
{
    public function __construct(
        public readonly string $reservationId,
        public readonly string $roomId,
        public readonly string $email,
        public readonly \DateTimeImmutable $checkinDate,
        public readonly \DateTimeImmutable $checkoutDate,
        private int $duration,
        private float $price,
        private readonly string $status
    ) {
    }

    public static function create(
        string $roomId,
        string $email,
        \DateTimeImmutable $checkinDate,
        \DateTimeImmutable $checkoutDate
    ): Reservation {
        $uuid = Uuid::uuid4()->toString();
        $duration = 0;
        $price = 0;
        $status = 'active';
        return new Reservation(
            $uuid,
            $roomId,
            $email,
            $checkinDate,
            $checkoutDate,
            $duration,
            $price,
            $status
        );
    }

    public function calculate(Room $room): void
    {
        $output = PriceCalculatorFactory::create($room->type)->calculate(
            $this->checkinDate,
            $this->checkoutDate,
            $room->price
        );
        $this->duration = $output->duration;
        $this->price = $output->price;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
