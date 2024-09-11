<?php

declare(strict_types=1);

namespace Src\Dip;

use Src\DatabaseConnection;

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
