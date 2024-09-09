<?php

namespace Src\Dip;

use Src\DatabaseConnection;

class TicketRepositoryDatabase implements TicketRepository
{

    public function __construct(private readonly DatabaseConnection $databaseConnection)
    {
    }

    public function getTicketById(string $ticketId): Ticket
    {
        [$ticket] = $this->databaseConnection->query(
            'SELECT * FROM dip.tickets WHERE ticket_id = $1',
            [$ticketId]
        );
        return new Ticket($ticket['ticket_id'], $ticket['event_id'], $ticket['email'], $ticket['price']);
    }

    public function saveTicket(Ticket $ticket): void
    {
        $this->databaseConnection->query(
            'INSERT INTO dip.tickets (ticket_id, event_id, email, price) VALUES ($1, $2, $3, $4)',
            [$ticket->ticketId, $ticket->eventId, $ticket->email, $ticket->price]
        );
    }
}
