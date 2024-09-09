<?php

namespace Src\Dip;

class PurchaseTicketOutput
{
    public function __construct(
        public readonly string $ticketId
    ) {
    }
}
