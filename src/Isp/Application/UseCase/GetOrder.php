<?php

declare(strict_types=1);

namespace Src\Isp\Application\UseCase;

use Src\Isp\Application\Repository\OrderRepository;
use Src\Isp\Domain\Order;

class GetOrder
{
    public function __construct(public readonly OrderRepository $orderRepository)
    {
    }

    public function execute(string $orderId): Order
    {
        return $this->orderRepository->getOrder($orderId);
    }
}
