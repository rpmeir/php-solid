<?php

declare(strict_types=1);

namespace Src\Isp\Infra\Gateway;

use Src\Isp\Application\Dtos\CurrencyOutput;
use Src\Isp\Application\Gateway\CurrencyGateway;

class CurrencyGatewayFake implements CurrencyGateway
{
    public function getCurrency(): CurrencyOutput
    {
        return new CurrencyOutput(6.0);
    }
}
