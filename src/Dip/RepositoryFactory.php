<?php

declare(strict_types=1);

namespace Src\Dip;

interface RepositoryFactory
{
    public function createEventRepository(): EventRepository;
    public function createTicketRepository(): TicketRepository;
}
