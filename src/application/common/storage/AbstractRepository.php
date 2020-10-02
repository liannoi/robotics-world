<?php

declare(strict_types=1);

namespace RoboticsWorld\Application\Common\Storage;

require_once "application/common/storage/RepositoryInterface.php";

use mysqli_stmt;

abstract class AbstractRepository implements RepositoryInterface
{
    protected DbContextInterface $context;

    public function __construct(DbContextInterface $context)
    {
        $this->context = $context;
    }

    protected function query(string $query, string $types, &$var1, &...$_): mysqli_stmt
    {
        $statement = $this->context->prepare($query);
        $statement->bind_param($types, $var1, ...$_);
        $this->context->safeExecute($statement);

        return $statement;
    }
}
