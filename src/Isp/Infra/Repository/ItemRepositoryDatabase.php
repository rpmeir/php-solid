<?php

declare(strict_types=1);

namespace Src\Isp\Infra\Repository;

use Src\DatabaseConnection;
use Src\Isp\Application\Repository\ItemRepository;
use Src\Isp\Domain\Item;

class ItemRepositoryDatabase implements ItemRepository
{
    public function __construct(public readonly DatabaseConnection $connection)
    {
        // not implemented
    }

    public function saveItem(Item $item): int
    {
        return $this->connection->execute(
            'INSERT INTO isp.items (item_id, order_id, product_id, quantity, unit_price, total)
                        VALUES (:item_id, :order_id, :product_id, :quantity, :unit_price, :total)',
            [
                'item_id' => $item->itemId,
                'order_id' => $item->orderId,
                'product_id' => $item->productId,
                'quantity' => $item->quantity,
                'unit_price' => $item->unitPrice,
                'total' => $item->total
            ]
        );
    }

    /**
     * @param string $orderId
     * @return Item[]
     */
    public function getItemsByOrderId(string $orderId): array
    {
        $data = $this->connection->query('SELECT * FROM isp.items WHERE order_id = :id', ['id' => $orderId]);
        return array_map(
            fn($item) => new Item(
                $item['item_id'],
                $item['order_id'],
                $item['product_id'],
                (int) $item['quantity'],
                (float) $item['unit_price'],
                (float) $item['total']
            ),
            $data
        );
    }
}
