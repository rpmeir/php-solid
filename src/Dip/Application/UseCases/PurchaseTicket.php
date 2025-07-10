<?php

declare(strict_types=1);

namespace Src\Dip\Application\UseCases;

use Src\Dip\Application\Dtos\PurchaseTicketOutput;
use Src\Dip\Application\Repository\EventRepository;
use Src\Dip\Application\Repository\RepositoryFactory;
use Src\Dip\Application\Repository\TicketRepository;
use Src\Dip\Domain\Entities\Ticket;

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
     *
     * @param array<string, string> $input
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
