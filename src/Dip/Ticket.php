<?php

namespace Src\Dip;

use Ramsey\Uuid\Uuid;

class Ticket
{
    private Email $email;

    public function __construct(
        public readonly string $ticketId,
        public readonly string $eventId,
        public string $emailString,
        public readonly float $price
    ) {
        $this->email = new Email($emailString);

        // validate price
        if($price <= 0) {
            throw new \InvalidArgumentException('Invalid price');
        }
    }

    public static function create(string $eventId, string $email, float $price): Ticket
    {
        $uuid = Uuid::uuid4()->toString();
        return new Ticket(
            $uuid,
            $eventId,
            $email,
            $price
        );
    }

    public function getEmail(): string
    {
        return $this->email->getValue();
    }
}
