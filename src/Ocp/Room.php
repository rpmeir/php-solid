<?php

namespace Src\Ocp;

class Room
{
    public function __construct(
        public readonly string $roomId,
        public readonly string $type,
        public readonly float $price
    ) {}
}
