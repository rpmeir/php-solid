<?php

declare(strict_types=1);

namespace Src\Dip\Application\Repository;

use Src\Dip\Domain\Entities\Ticket;

interface TicketRepository
{
    public function getTicketById(string $ticketId): Ticket;
    public function saveTicket(Ticket $ticket): void;
}
