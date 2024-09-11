<?php

namespace Src\Dip;

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
