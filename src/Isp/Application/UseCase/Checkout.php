<?php

declare(strict_types=1);

namespace Src\Isp\Application\UseCase;

use Src\Isp\Application\Dtos\CheckoutInput;
use Src\Isp\Application\Dtos\CheckoutOutput;
use Src\Isp\Application\Dtos\PaymentGatewayInput;
use Src\Isp\Application\Gateway\CurrencyGatewayCheckout;
use Src\Isp\Application\Gateway\PaymentGatewayCheckout;
use Src\Isp\Application\Repository\ItemRepositoryCheckout;
use Src\Isp\Application\Repository\OrderRepositoryCheckout;
use Src\Isp\Application\Repository\ProductRepositoryCheckout;
use Src\Isp\Domain\Item;
use Src\Isp\Domain\Order;

class Checkout
{

    public function __construct(
        public readonly ProductRepositoryCheckout $productRepository,
        public readonly OrderRepositoryCheckout $orderRepository,
        public readonly ItemRepositoryCheckout $itemRepository,
        public readonly PaymentGatewayCheckout $paymentGateway,
        public readonly CurrencyGatewayCheckout $currencyGateway)
    {
    }

    public function execute(CheckoutInput $input): CheckoutOutput
    {
        $order = Order::create($input->email);
        $this->orderRepository->saveOrder($order);
        foreach ($input->items as $item) {
            if (empty($item->productId)) {
                throw new \InvalidArgumentException('Product ID cannot be null or empty.');
            }
            $product = $this->productRepository->getProduct($item->productId);
            $item = Item::create($order->orderId, $product->productId, $item->quantity, $product->price);
            $this->itemRepository->saveItem($item);
            $order->addItem($product, $item->quantity);
        }
        $paymentGatewaInput = new PaymentGatewayInput($input->creditCardToken, $order->total);
        $outputProcessPayment = $this->paymentGateway->processPayment($paymentGatewaInput);
        if ($outputProcessPayment->status === 'approved') {
            $order->confirmPayment();
        }
        $currencyOutput = $this->currencyGateway->getCurrency();
        $order->calculateTotalInUsd($currencyOutput->value);
        $this->orderRepository->updateOrder($order);
        return new CheckoutOutput($order->orderId);
    }
}
