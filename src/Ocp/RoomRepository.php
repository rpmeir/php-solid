<?php

namespace Src\Ocp;

interface RoomRepository
{
    public function get(string $roomId): Room;
}
