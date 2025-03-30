<?php

declare(strict_types=1);

use Src\Isp\Application\Dtos\CheckoutInput;
use Src\Isp\Application\UseCase\Checkout;
use Src\Isp\Application\UseCase\GetOrder;
use Src\Isp\Infra\Gateway\CurrencyGatewayFake;
use Src\Isp\Infra\Gateway\CurrencyGatewayHttp;
use Src\Isp\Infra\Gateway\PaymentGatewayFake;
use Src\Isp\Infra\Gateway\PaymentGatewayHttp;
use Src\Isp\Infra\Repository\ItemRepositoryDatabase;
use Src\Isp\Infra\Repository\OrderRepositoryDatabase;
use Src\Isp\Infra\Repository\ProductRepositoryDatabase;
use Src\PostgresDatabaseAdapter;

pest()->group('integration', 'isp');

$connection = new PostgresDatabaseAdapter();
$productRepository = new ProductRepositoryDatabase($connection);
$itemRepository = new ItemRepositoryDatabase($connection);
$orderRepository = new OrderRepositoryDatabase($connection, $itemRepository);
$externalDependencies = 'fake'; // 'http' or 'fake'
$paymentGateway = $externalDependencies === 'http'
    ? new PaymentGatewayHttp()
    : new PaymentGatewayFake();
$currencyGateway = $externalDependencies === 'http'
    ? new CurrencyGatewayHttp()
    : new CurrencyGatewayFake();

test('Deve fazer checkout', function () use (
    $productRepository,
    $itemRepository,
    $orderRepository,
    $paymentGateway,
    $currencyGateway) {
        $checkoutInput = new CheckoutInput(
            'john.doe@gmail.com',
            'tok_1JXK8wFqKHZbDcxRm0KwRg0E',
            [
                ['productId' => 'ae190ae8-e230-4f35-afb6-b4782366c38c', 'quantity' => 1],
                ['productId' => 'b20cf780-e23e-42aa-8757-577f3442fef8', 'quantity' => 2]
            ]
        );
        expect($checkoutInput->items)->toBeArray();
        expect($checkoutInput->items[0]['productId'])->not->toBeNull();
        $checkout = new Checkout($productRepository, $orderRepository, $itemRepository, $paymentGateway, $currencyGateway
        );
        $outputCheckout = $checkout->execute($checkoutInput);
        expect($outputCheckout)->toHaveAttribute('orderId');
        $getOrder = new GetOrder($orderRepository);
        $outputGetOrder = $getOrder->execute($outputCheckout->orderId);
        expect($outputGetOrder)->toHaveAttribute('total');
        expect($outputGetOrder->total)->toBe(2000);
        expect($outputGetOrder->totalInUsd)->toBe(12000);
        expect($outputGetOrder->status)->toBe('paid');
});
