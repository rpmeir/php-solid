<?php

declare(strict_types=1);

namespace Src;

interface DatabaseConnection
{
    /**
     * Summary of query
     *
     * @param array<string|int|float> $parameters
     *
     * @return array<array<string, string|int|float>>
     */
    public function query(string $statement, array $parameters): array;
    public function close(): void;
}
