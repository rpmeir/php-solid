<?php

namespace Src\Lsp;

class PostgresDatabaseAdapter implements DatabaseConnection
{
    private ?\PDO $connection;

    public function __construct() {
        $this->connection = new \PDO(
            "pgsql:dbname=postgres;host=127.0.0.1;port=5432",
            "postgres",
            "123456"
        );
    }

    /**
     * Summary of query
     * @param string $statement
     * @param array<int|string> $parameters
     * @return array<array<string, string>>
     */
    public function query(string $statement, array $parameters): array
    {
        if (!$this->connection) {
            throw new ConnectionException('Connection not established');
        }
        $sth = $this->connection->prepare($statement);
        $sth->execute($parameters);
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function close(): void
    {
        $this->connection = null;
    }
}
