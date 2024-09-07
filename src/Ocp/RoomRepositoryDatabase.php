<?php

namespace Src\Ocp;

use Src\DatabaseConnection;

class RoomRepositoryDatabase implements RoomRepository
{
    public function __construct(public readonly DatabaseConnection $databaseConnection) {}

    public function get(string $roomId): Room
    {
        [$room] = $this->databaseConnection->query(
            'SELECT room_id, type, price FROM ocp.rooms WHERE room_id = ?',
            [$roomId]
        );
        return new Room(
            (string) $room['room_id'],
            (string) $room['type'],
            (float) $room['price']
        );
    }
}
