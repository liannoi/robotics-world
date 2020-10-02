<?php

declare(strict_types=1);

namespace App\Models;

require_once "config/database.php";

use mysqli;
use mysqli_result;
use mysqli_sql_exception;
use mysqli_stmt;

abstract class AbstractModel
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
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

    abstract public function create($entity): void;

    abstract public function getAll(): array;

    abstract public function getById($id);

    abstract public function update($entity): void;

    abstract public function delete($id): void;

    protected function query(string $query, string $types, &$var1, &...$_): mysqli_stmt
    {
        $statement = $this->prepare($query);
        $statement->bind_param($types, $var1, ...$_);
        $this->safeExecute($statement);

        return $statement;
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
}
