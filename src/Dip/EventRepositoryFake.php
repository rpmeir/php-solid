<?php

declare(strict_types=1);

namespace Src\Dip;

class EventRepositoryFake implements EventRepository
{
    public function getEventById(string $eventId): Event
    {
        return new Event('185ff433-a7df-4dd6-ac86-44d219645cb1', 'A', 100.0);
    }
}
