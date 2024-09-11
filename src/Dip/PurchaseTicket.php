<?php

namespace Src\Dip;

class PurchaseTicket
{
    private EventRepository $eventRepository;
    private TicketRepository $ticketRepository;

    public function __construct(public readonly RepositoryFactory $repositoryFactory)
    {
        $this->eventRepository = $repositoryFactory->createEventRepository();
        $this->ticketRepository = $repositoryFactory->createTicketRepository();
    }

    /**
     * Summary of execute
     * @param array<string, string> $input
     * @return PurchaseTicketOutput
     */
    public function execute(array $input): PurchaseTicketOutput
    {
        $event = $this->eventRepository->getEventById($input['eventId']);
        $ticket = Ticket::create(
            $input['eventId'],
            $input['email'],
            $event->price
        );
        $this->ticketRepository->saveTicket($ticket);
        return new PurchaseTicketOutput($ticket->ticketId);
    }
}
