<?php

declare(strict_types=1);

namespace Src\Dip;

interface EventRepository
{
    public function getEventById(string $eventId): Event;
}
