<?php

namespace Src\Dip;

interface EventRepository
{
    public function getEventById(string $eventId): Event;
}
