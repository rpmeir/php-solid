<?php

declare(strict_types=1);

namespace Src\Ocp\Application\Repository;

use Src\Ocp\Domain\Room;

interface RoomRepository
{
    public function get(string $roomId): Room;
}
