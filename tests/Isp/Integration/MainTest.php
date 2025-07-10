<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../vendor/autoload.php';

use GuzzleHttp\Client;
use Src\Isp\Application\Dtos\CheckoutInput;

test('Deve fazer um pedido', function ()
{
    $checkoutInput = new CheckoutInput(
        'john.doe@gmail.com',
        'tok_1JXK8wFqKHZbDcxRm0KwRg0E',
        [
            ['productId' => 'ae190ae8-e230-4f35-afb6-b4782366c38c', 'quantity' => 1],
            ['productId' => 'b20cf780-e23e-42aa-8757-577f3442fef8', 'quantity' => 2]
        ]
    );
    $client = new Client();
    $responseCheckout = $client->post('http://localhost:8000/checkout', [
        'json' => $checkoutInput
    ]);
    $outputCheckout = json_decode($responseCheckout->getBody()->getContents(), true);
    expect($outputCheckout)->toHaveKey('orderId');
    $responseGetOrder = $client->get('http://localhost:8000/orders/' . $outputCheckout['orderId']);
    $outputGetOrder = json_decode($responseGetOrder->getBody()->getContents(), true);
    expect($outputGetOrder['total'])->toBe(2000);
    expect($outputGetOrder['totalInUsd'])->toBe(12000);
    expect($outputGetOrder['status'])->toBe('paid');
})->group('integration', 'isp');
