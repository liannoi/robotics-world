<?php

declare(strict_types=1);

namespace App\Models;

require_once "app/Models/ActiveRecord.php";

class UserRole extends ActiveRecord
{
    public int $userId;
    public int $roleId;
    public bool $isRemoved;

    public function __construct(array $associative = array())
    {
        parent::__construct();
        $this->userId = (int)$associative["UserId"] ?? 0;
        $this->roleId = (int)$associative["RoleId"] ?? 0;
    }

    public function create(): void
    {
        $query = "INSERT INTO UserRoles (UserId, RoleId) VALUES (?, ?)";

        $this->query($query, "ii", $this->userId, $this->roleId);
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM UserRoles";

        return $this->mapFrom($query, UserRole::class);
    }

    public function getRolesById(): array
    {
        $query = "SELECT R.Name FROM UserRoles AS UR";
        $query .= " INNER JOIN Roles AS R ON UR.RoleId = R.RoleId";
        $query .= " WHERE UR.UserId = {$this->userId};";

        return $this->mapFrom($query, Role::class);
    }

    public function getById(): UserRole
    {
        $query = "SELECT * FROM UserRoles WHERE UserId = ? AND RoleId = ?";

        return new UserRole(
            $this->query($query, "i", $this->userId, $this->roleId)
                ->get_result()
                ->fetch_assoc()
        );
    }

    public function update(): void
    {
        $query = "UPDATE UserRoles SET RoleId = ? WHERE UserId = ?";

        $this->query($query, "ii", $this->roleId, $this->userId);
    }

    public function delete(): void
    {
        $query = "DELETE FROM UserRoles WHERE RoleId = ? AND UserId = ?";

        $this->query($query, "ii", $this->roleId, $this->userId);
    }
}

class UserRoleBuilder
{
    private array $associative = [];

    public function withUser(int $userId): UserRoleBuilder
    {
        $this->associative["UserId"] = $userId;

        return $this;
    }

    public function withRole(int $roleId): UserRoleBuilder
    {
        $this->associative["RoleId"] = $roleId;

        return $this;
    }

    public function build(): UserRole
    {
        return new UserRole($this->associative);
    }
}
