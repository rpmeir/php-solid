<?php

declare(strict_types=1);

namespace Src\Dip;

class PurchaseTicketOutput
{
    public function __construct(
        public readonly string $ticketId
    ) {
    }
}
