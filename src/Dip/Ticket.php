<?php

namespace Src\Dip;

class Ticket
{
    public function __construct(
        public readonly string $ticketId,
        public readonly string $eventId,
        public readonly string $email,
        public readonly float $price
    ) {}
}
