<?php

declare(strict_types=1);

namespace App\Http;

class User
{
    public string $username;
    public bool $havePermissions;

    public function __construct(string $username, bool $havePermissions)
    {
        $this->username = $username;
        $this->havePermissions = $havePermissions;
    }
}
