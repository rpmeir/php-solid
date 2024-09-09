<?php

namespace Src\Dip;

class GetTicket
{
    public function __construct(public readonly TicketRepository $ticketRepository)
    {
    }

    public function execute(string $ticketId): Ticket
    {
        return $this->ticketRepository->getTicketById($ticketId);
    }

}
