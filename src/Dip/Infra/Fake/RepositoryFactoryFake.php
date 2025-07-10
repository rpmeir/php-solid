<?php

declare(strict_types=1);

namespace Src\Dip\Infra\Fake;

use Src\Dip\Application\Repository\EventRepository;
use Src\Dip\Application\Repository\RepositoryFactory;
use Src\Dip\Application\Repository\TicketRepository;

class RepositoryFactoryFake implements RepositoryFactory
{
    public function createEventRepository(): EventRepository
    {
        return new EventRepositoryFake();
    }

    public function createTicketRepository(): TicketRepository
    {
        return TicketRepositoryFake::getInstance();
    }
}
