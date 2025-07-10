<?php

declare(strict_types=1);

namespace Src\Dip\Application\Repository;

use Src\Dip\Domain\Entities\Event;

interface EventRepository
{
    public function getEventById(string $eventId): Event;
}
