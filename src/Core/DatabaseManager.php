<?php

namespace App\Core;

use App\Interfaces\Core\DatabaseManagerInterface;
use PDO;
use PDOException;

class DatabaseManager implements DatabaseManagerInterface
{
    private PDO $connection;

    public function __construct(?string $host, ?string $dbname, ?string $user, ?string $password, ?PDO $connection = null)
    {
        if ($connection) {
            return $this->connection = $connection;
        }

        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            $this->connection = new PDO($dsn, $user, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new \Exception('Connection failed: ' . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
