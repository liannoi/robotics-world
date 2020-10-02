<?php

declare(strict_types=1);

namespace RoboticsWorld\Domain\Entities;

class Role
{
    private int $roleId;
    private string $name;
    private bool $isRemoved;
}
