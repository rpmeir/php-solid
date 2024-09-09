<?php

namespace Src\Dip;

interface TicketRepository
{
    public function getTicketById(string $ticketId): Ticket;
    public function saveTicket(Ticket $ticket): void;
}
