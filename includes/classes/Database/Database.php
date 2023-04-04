<?php namespace Klantreserveringen\Databases;

/**
 * Class Database
 * @package Klantreserveringen\Databases
 */
class Database
{
    /**
     * @var \PDO
     */
    private \PDO $connection;

    /**
     * Database constructor.
     *
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $database
     * @throws \Exception
     */
    public function __construct(
        private string $host,
        private string $username,
        private string $password,
        private string $database
    ) {
        $this->connect();
    }

/**
 * @throws \Exception
 */
private function connect(): void
{
    try {
        $this->connection = new \PDO(
            "mysql:dbname=$this->database;host=$this->host",
            $this->username,
            $this->password
        );
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
        throw new \Exception("DB connection failed: {$e->getMessage()}");
    }
}

/**
 * @return \PDO
 */
public function getConnection(): \PDO
{
    return $this->connection;
}
}
