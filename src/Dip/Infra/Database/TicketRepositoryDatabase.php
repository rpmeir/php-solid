<?php

declare(strict_types=1);

namespace Src\Dip\Infra\Database;

use Src\DatabaseConnection;
use Src\Dip\Application\Repository\TicketRepository;
use Src\Dip\Domain\Entities\Ticket;

class TicketRepositoryDatabase implements TicketRepository
{
    public function __construct(private readonly DatabaseConnection $databaseConnection)
    {
    }

    public function saveTicket(Ticket $ticket): void
    {
        $this->databaseConnection->query(
            'INSERT INTO dip.tickets (ticket_id, event_id, email, price) VALUES (?, ?, ?, ?)',
            [$ticket->ticketId, $ticket->eventId, $ticket->getEmail(), $ticket->price]
        );
    }

    public function getTicketById(string $ticketId): Ticket
    {
        [$ticket] = $this->databaseConnection->query(
            'SELECT * FROM dip.tickets WHERE ticket_id = ?',
            [$ticketId]
        );
        return new Ticket(
            (string) $ticket['ticket_id'],
            (string) $ticket['event_id'],
            (string) $ticket['email'],
            (float) $ticket['price']
        );
    }
}
