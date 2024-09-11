<?php

namespace Src\Dip;

interface RepositoryFactory
{
    public function createEventRepository(): EventRepository;
    public function createTicketRepository(): TicketRepository;
}
