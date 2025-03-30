<?php

declare(strict_types=1);

namespace Src\Isp\Domain;

use Ramsey\Uuid\Uuid;

class Item
{
    public function __construct(
        public readonly string $itemId,
        public readonly string $orderId,
        public readonly string $productId,
        public readonly int $quantity,
        public readonly float $unitPrice,
        public readonly float $total
    ) {
    }

    public static function create(string $orderId, string $productId, int $quantity, float $unitPrice): self
    {
        $itemId = Uuid::uuid4()->toString();
        $total = $unitPrice * $quantity;
        return new self($itemId, $orderId, $productId, $quantity, $unitPrice, $total);
    }
}
