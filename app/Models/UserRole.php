<?php

declare(strict_types=1);

namespace App\Models;

require_once "app/Models/AbstractModel.php";

class UserRole extends AbstractModel
{
    public int $userId;
    public int $roleId;
    public bool $isRemoved;

    public function __construct(array $associative)
    {
        parent::__construct();
        $this->userId = (int)$associative["UserId"] ?? 0;
        $this->roleId = (int)$associative["RoleId"] ?? 0;
    }

    public function create($entity): void
    {
        $this->query(
            "INSERT INTO UserRoles (UserId, RoleId) VALUES (?, ?)",
            "ii",
            $entity->userId,
            $entity->roleId
        );
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM UserRoles";

        return $this->mapFrom($query, UserRole::class);
    }

    public function getById($id)
    {
        return new UserRole(
            $this->query("SELECT * FROM UserRoles WHERE UserId = ?", "i", $id)
                ->get_result()
                ->fetch_assoc()
        );
    }

    public function update($entity): void
    {
        $this->query(
            "UPDATE UserRoles SET RoleId = ? WHERE UserId = ?",
            "ii",
            $entity->roleId,
            $entity->userId
        );
    }

    public function delete($entity): void
    {
        $this->query(
            "DELETE FROM UserRoles WHERE RoleId = ? AND UserId = ?",
            "ii",
            $entity->roleId,
            $entity->userId
        );
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
