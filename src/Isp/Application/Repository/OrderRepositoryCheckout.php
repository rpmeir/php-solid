<?php

declare(strict_types=1);

namespace Src\Isp\Application\Repository;

use Src\Isp\Domain\Order;

interface OrderRepositoryCheckout
{
    public function saveOrder(Order $order): int;
    public function updateOrder(Order $order): int;
}
