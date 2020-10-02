<?php

declare(strict_types=1);

namespace App\Http;

class UserRole
{
    private int $userId;
    private int $roleId;
    private bool $isRemoved;
}
