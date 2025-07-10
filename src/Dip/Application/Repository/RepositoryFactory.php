<?php

declare(strict_types=1);

namespace Src\Dip\Application\Repository;

interface RepositoryFactory
{
    public function createEventRepository(): EventRepository;
    public function createTicketRepository(): TicketRepository;
}
