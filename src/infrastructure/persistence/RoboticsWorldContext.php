<?php

declare(strict_types=1);

namespace RoboticsWorld\Infrastructure\Persistence;

require_once "application/common/storage/DbContextInterface.php";
require_once "application/ApplicationDefaults.php";
require_once "domain/entities/Status.php";

use mysqli;
use mysqli_result;
use mysqli_sql_exception;
use mysqli_stmt;
use RoboticsWorld\Application\Common\Storage\DbContextInterface;

class RoboticsWorldContext implements DbContextInterface
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public function prepare(string $query): mysqli_stmt
    {
        return $this->connection->prepare($query);
    }

    public function safeExecute(mysqli_stmt $statement)
    {
        if (!$statement->execute()) {
            var_dump($this->connection->error_list);
            throw new mysqli_sql_exception($this->connection->error_list[0]["error"]);
        }
    }

    public function mapFrom(string $query, string $class): array
    {
        return $this->mapFromStatement($this->execute($query), $class);
    }

    private function mapFromStatement(mysqli_result $statement, string $class): array
    {
        $result = [];

        while ($row = $statement->fetch_assoc()) {
            $result[] = new $class($row);
        }

        return $result;
    }

    private function execute(string $query): mysqli_result
    {
        return $this->connection->query($query);
    }
}
