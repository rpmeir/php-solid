<?php

declare(strict_types=1);

namespace Src\Dip\Application\UseCases;

use Src\Dip\Application\Repository\RepositoryFactory;
use Src\Dip\Application\Repository\TicketRepository;
use Src\Dip\Domain\Entities\Ticket;

class GetTicket
{
    private TicketRepository $ticketRepository;

    public function __construct(public readonly RepositoryFactory $repositoryFactory)
    {
        $this->ticketRepository = $repositoryFactory->createTicketRepository();
    }

    public function execute(string $ticketId): Ticket
    {
        return $this->ticketRepository->getTicketById($ticketId);
    }
}
