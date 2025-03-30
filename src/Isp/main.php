<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Src\Isp\Application\Dtos\CheckoutInput;
use Src\Isp\Application\UseCase\Checkout;
use Src\Isp\Application\UseCase\GetOrder;
use Src\PostgresDatabaseAdapter;

require_once __DIR__ . '/../../vendor/autoload.php';

$app = AppFactory::create();

$connection = new PostgresDatabaseAdapter();
$productRepository = new \Src\Isp\Infra\Repository\ProductRepositoryDatabase($connection);
$itemRepository = new \Src\Isp\Infra\Repository\ItemRepositoryDatabase($connection);
$orderRepository = new \Src\Isp\Infra\Repository\OrderRepositoryDatabase($connection, $itemRepository);
$paymentGateway = new \Src\Isp\Infra\Gateway\PaymentGatewayHttp();
$currencyGateway = new \Src\Isp\Infra\Gateway\CurrencyGatewayHttp();

$app->post('/checkout', function (Request $request, Response $response) use ($productRepository, $itemRepository, $orderRepository, $paymentGateway, $currencyGateway) {
    $input = json_decode($request->getBody()->getContents());
    $checkout = new Checkout($productRepository, $orderRepository, $itemRepository, $paymentGateway, $currencyGateway);
    $checkoutInput = new CheckoutInput($input->email, $input->creditCardToken, $input->items);
    $output = $checkout->execute($checkoutInput);
    $response->getBody()->write(json_encode($output));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/orders/{orderId}', function (Request $request, Response $response) use ($orderRepository) {
    $getOrder = new GetOrder($orderRepository);
    $output = $getOrder->execute($request->getAttribute('orderId'));
    $response->getBody()->write(json_encode($output));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
