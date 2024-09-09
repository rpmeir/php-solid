<?php

namespace Src\Dip;

use Ramsey\Uuid\Uuid;

class PurchaseTicket
{
    public function __construct(
        public readonly TicketRepository $ticketRepository,
        public readonly EventRepository $eventRepository)
    {
    }

    public function execute(array $input): object
    {
        $event = $this->eventRepository->getEventById($input['eventId']);
        $ticket = new Ticket(
            Uuid::uuid4()->toString(),
            $input['eventId'],
            $input['email'],
            $event->price
        );
        $this->ticketRepository->saveTicket($ticket);
        return new PurchaseTicketOutput($ticket->ticketId);
    }
}
