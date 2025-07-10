<?php

declare(strict_types=1);

namespace Src\Dip\Infra\Database;

use Src\DatabaseConnection;
use Src\Dip\Application\Repository\EventRepository;
use Src\Dip\Domain\Entities\Event;

class EventRepositoryDatabase implements EventRepository
{
    public function __construct(private readonly DatabaseConnection $databaseConnection)
    {
    }

    public function getEventById(string $eventId): Event
    {
        [$eventData] = $this->databaseConnection->query(
            'SELECT * FROM dip.events WHERE event_id = ?',
            [$eventId]
        );
        return new Event((string) $eventData['event_id'], (string) $eventData['description'], (float) $eventData['price']);
    }
}
