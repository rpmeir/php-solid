<?php

namespace Src;

use Dotenv\Dotenv;

class PostgresDatabaseAdapter implements DatabaseConnection
{
    private ?\PDO $connection;

    public function __construct() {
        Dotenv::createImmutable(__DIR__ . '/..')->load();

        $dbname = $_ENV['DATABASE_NAME'];
        $host = $_ENV['DATABASE_HOST'];
        $port = $_ENV['DATABASE_PORT'];
        $dsn = "pgsql:dbname=$dbname;host=$host;port=$port";

        $this->connection = new \PDO(
            $dsn,
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASS']
        );
    }

    /**
     * Summary of query
     * @param string $statement
     * @param array<int|float|string> $parameters
     * @return array<array<string, int|float|string>>
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
