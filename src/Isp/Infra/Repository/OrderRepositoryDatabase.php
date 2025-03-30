<?php

declare(strict_types=1);

namespace Src\Isp\Infra\Repository;

use Src\DatabaseConnection;
use Src\Isp\Application\Repository\ItemRepository;
use Src\Isp\Application\Repository\OrderRepository;
use Src\Isp\Domain\Order;

class OrderRepositoryDatabase implements OrderRepository
{
    public function __construct(
        public readonly DatabaseConnection $connection,
        public readonly ItemRepository $itemRepository)
    {
        // not implemented
    }

    public function saveOrder(Order $order): int
    {
        return $this->connection->execute(
            'INSERT INTO isp.orders (order_id, email, total, total_in_usd, status) VALUES (:order_id, :email, :total, :total_in_usd, :status)',
            [
                'order_id' => $order->orderId,
                'email' => $order->email,
                'total' => $order->total,
                'total_in_usd' => $order->totalInUsd,
                'status' => $order->status
            ]
        );
    }

    public function getOrder(string $orderId): Order
    {
        $data = $this->connection->query('SELECT * FROM isp.orders WHERE order_id = :id', ['id' => $orderId]);
        $items = $this->itemRepository->getItemsByOrderId($data[0]['order_id']);
        return new Order(
            $data[0]['order_id'],
            $data[0]['email'],
            (float) $data[0]['total'],
            (float) $data[0]['total_in_usd'],
            $data[0]['status'],
            $items
        );
    }

    public function updateOrder(Order $order): int
    {
        return $this->connection->execute(
            'UPDATE isp.orders SET email = :email, total = :total, total_in_usd = :total_in_usd, status = :status WHERE order_id = :order_id',
            [
                'order_id' => $order->orderId,
                'email' => $order->email,
                'total' => $order->total,
                'total_in_usd' => $order->totalInUsd,
                'status' => $order->status
            ]
        );
    }
}
