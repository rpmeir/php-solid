<?php

declare(strict_types=1);

namespace Src\Isp\Infra\Gateway;

use GuzzleHttp\Client;
use Src\Isp\Application\Dtos\PaymentGatewayInput;
use Src\Isp\Application\Dtos\PaymentGatewayOutput;
use Src\Isp\Application\Gateway\PaymentGateway;

class PaymentGatewayHttp implements PaymentGateway
{
    public function __construct()
    {
        // not implemented
    }

    public function processPayment(PaymentGatewayInput $input): PaymentGatewayOutput
    {
        $client = new Client();
        $responsePayment = $client->post('http://localhost:8002/process_payment', [
            'json' => ['creditCardToken' => $input->creditCardToken, 'amount' => $input->amount]
        ]);
        $paymentData = json_decode($responsePayment->getBody()->getContents());
        return new PaymentGatewayOutput($paymentData->tid, $paymentData->status);
    }
}
