<?php

declare(strict_types=1);

namespace Src\Dip\Infra\Database;

use Src\DatabaseConnection;
use Src\Dip\Application\Repository\EventRepository;
use Src\Dip\Application\Repository\RepositoryFactory;
use Src\Dip\Application\Repository\TicketRepository;

class RepositoryFactoryDatabase implements RepositoryFactory
{
    public function __construct(private readonly DatabaseConnection $databaseConnection)
    {
    }

    public function createEventRepository(): EventRepository
    {
        return new EventRepositoryDatabase($this->databaseConnection);
    }

    public function createTicketRepository(): TicketRepository
    {
        return new TicketRepositoryDatabase($this->databaseConnection);
    }
}
