<?php

declare(strict_types=1);


use Src\Isp\Infra\Repository\ProductRepositoryDatabase;
use Src\PostgresDatabaseAdapter;

pest()->group('integration', 'isp');

describe('ProductRepositoryTest', function () {
    test('Deve obter um produto', function () {
        $connection = new PostgresDatabaseAdapter();
        $productRepository = new ProductRepositoryDatabase($connection);
        $product = $productRepository->getProduct('ae190ae8-e230-4f35-afb6-b4782366c38c');
        expect($product)->toBeInstanceOf(\Src\Isp\Domain\Product::class);
        expect($product->description)->toBe('A');
        expect($product->price)->toBe(1000.0);
    });
});
