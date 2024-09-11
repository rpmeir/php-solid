<?php

declare(strict_types=1);

namespace Src\Ocp;

interface RoomRepository
{
    public function get(string $roomId): Room;
}
