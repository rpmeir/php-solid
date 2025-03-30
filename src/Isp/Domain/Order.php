<?php

declare(strict_types=1);

namespace Src\Isp\Domain;

use Ramsey\Uuid\Uuid;

class Order
{
    public function __construct(
        public readonly string $orderId,
        public readonly string $email,
        public float $total,
        public float $totalInUsd,
        public string $status,
        public array $items
    ) {
    }

    public static function create(string $email): self
    {
        $orderId = Uuid::uuid4()->toString();
        $total = 0;
        $totalInUsd = 0;
        $status = 'waiting_payment';
        $items = [];
        return new self($orderId, $email, $total, $totalInUsd, $status, $items);
    }

    public function addItem(Product $product, int $quantity): void
    {
        $itemTotal = $product->price * $quantity;
        $this->items[] = Item::create(
            $this->orderId,
            $product->productId,
            $quantity,
            $product->price
        );
        $this->total += $itemTotal;
    }

    public function calculateTotalInUsd(float $exchangeRate): void
    {
        $this->totalInUsd = $this->total * $exchangeRate;
    }

    public function confirmPayment(): void
    {
        $this->status = 'paid';
    }
}
