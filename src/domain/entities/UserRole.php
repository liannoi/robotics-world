<?php

declare(strict_types=1);

namespace RoboticsWorld\Domain\Entities;

class UserRole
{
    private int $userId;
    private int $roleId;
    private bool $isRemoved;
}
