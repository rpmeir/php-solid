<?php

declare(strict_types=1);

namespace Src\Isp\Infra\Repository;

use Src\DatabaseConnection;
use Src\Isp\Application\Repository\ProductRepository;
use Src\Isp\Domain\Product;

class ProductRepositoryDatabase implements ProductRepository
{
    public function __construct(public readonly DatabaseConnection $connection)
    {
        // not implemented
    }

    public function getProduct(string $id): Product
    {
        $data = $this->connection->query('SELECT * FROM isp.products WHERE product_id = :id', ['id' => $id]);
        return new Product($data[0]['product_id'], $data[0]['description'], (float) $data[0]['price']);
    }
}
