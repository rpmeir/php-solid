<?php

namespace Src\Lsp;

interface DatabaseConnection
{
    public function query(string $statement, array $parameters): array;
    public function close(): void;
}
