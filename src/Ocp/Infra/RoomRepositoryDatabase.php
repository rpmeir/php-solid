<?php

declare(strict_types=1);

namespace Src\Ocp\Infra;

use Src\DatabaseConnection;
use Src\Ocp\Application\Repository\RoomRepository;
use Src\Ocp\Domain\Room;

class RoomRepositoryDatabase implements RoomRepository
{
    public function __construct(public readonly DatabaseConnection $databaseConnection)
    {
    }

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
