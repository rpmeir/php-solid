<?php

declare(strict_types=1);

namespace Src\Dip;

class Event
{
    public function __construct(
        public readonly string $eventId,
        public readonly string $description,
        public readonly float $price
    ) {
    }
}
