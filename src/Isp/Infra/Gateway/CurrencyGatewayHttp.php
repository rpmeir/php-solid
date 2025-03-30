<?php

declare(strict_types=1);

namespace Src\Isp\Infra\Gateway;

use GuzzleHttp\Client;
use Src\Isp\Application\Dtos\CurrencyOutput;
use Src\Isp\Application\Gateway\CurrencyGateway;

class CurrencyGatewayHttp implements CurrencyGateway
{
    public function __construct()
    {
        // not implemented
    }

    public function getCurrency(): CurrencyOutput
    {
        $client = new Client();
        $responseCurrency = $client->get('http://localhost:8001/currency');
        $currencyData = json_decode($responseCurrency->getBody()->getContents());
        return new CurrencyOutput($currencyData->value);
    }
}
