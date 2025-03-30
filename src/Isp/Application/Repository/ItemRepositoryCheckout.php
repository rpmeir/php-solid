<?php

declare(strict_types=1);

namespace Src\Isp\Application\Repository;

use Src\Isp\Domain\Item;

interface ItemRepositoryCheckout
{
    public function saveItem(Item $item): int;
    /**
     * @param string $orderId
     * @return Item[]
     */
    public function getItemsByOrderId(string $orderId): array;
}
