<?php

declare(strict_types=1);

namespace Src\Dip;

use Src\DatabaseConnection;

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
