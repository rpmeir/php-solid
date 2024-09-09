<?php

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
            'SELECT * FROM dip.events WHERE event_id = $1',
            [$eventId]
        );
        return new Event($eventData['event_id'], $eventData['description'], $eventData['price']);
    }
}
