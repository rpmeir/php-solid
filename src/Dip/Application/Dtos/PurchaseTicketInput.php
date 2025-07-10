<?php

declare(strict_types=1);

namespace Src\Dip\Application\Dtos;

class PurchaseTicketInput
{
    public function __construct(
        public readonly string $eventId,
        public readonly string $email
    ) {
    }
}
