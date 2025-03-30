<?php

declare(strict_types=1);

namespace Src\Isp\Application\Repository;

use Src\Isp\Domain\Item;

interface ItemRepository extends ItemRepositoryCheckout
{
    public function saveItem(Item $item): int;
}
