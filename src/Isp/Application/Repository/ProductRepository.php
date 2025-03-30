<?php

declare(strict_types=1);

namespace Src\Isp\Application\Repository;

use Src\Isp\Domain\Product;

interface ProductRepository extends ProductRepositoryCheckout
{
    public function getProduct(string $id): Product;
}
