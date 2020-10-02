<?php

declare(strict_types=1);

namespace RoboticsWorld\Application\Common\Storage;

use mysqli_stmt;

interface DbContextInterface
{
    public function prepare(string $query): mysqli_stmt;

    public function safeExecute(mysqli_stmt $statement);

    public function mapFrom(string $query, string $class): array;
}
