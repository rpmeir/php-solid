<?php

namespace Src\Ocp;

interface DatabaseConnection
{
    /**
     * Summary of query
     * @param string $statement
     * @param array<string|int|float> $parameters
     * @return array<array<string, string|int|float>>
     */
    public function query(string $statement, array $parameters): array;
    public function close(): void;
}
