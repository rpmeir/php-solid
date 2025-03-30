<?php

declare(strict_types=1);

namespace Src\Isp\Application\Repository;

use Src\Isp\Domain\Order;

interface OrderRepository extends OrderRepositoryCheckout
{
    public function saveOrder(Order $order): int;
    public function getOrder(string $orderId): Order;
}
