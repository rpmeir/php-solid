<?php

declare(strict_types=1);

namespace Src\Isp\Application\Gateway;

use Src\Isp\Application\Dtos\CurrencyOutput;

interface CurrencyGateway extends CurrencyGatewayCheckout
{
    public function getCurrency(): CurrencyOutput;
}
