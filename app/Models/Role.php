<?php

declare(strict_types=1);

namespace App\Http;

require_once "app/Models/AbstractModel.php";

class Role extends AbstractModel
{
    public int $roleId;
    public string $name;
    public bool $isRemoved;

    public function __construct(array $associative)
    {
        parent::__construct();
        $this->roleId = (int)$associative["RoleId"] ?? 0;
        $this->name = $associative["Name"] ?? "";
        $this->isRemoved = (bool)$associative["IsRemoved"] ?? false;
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM Roles";

        return $this->mapFrom($query, Role::class);
    }

    public function getById($id)
    {
        return new Role(
            $this->query("SELECT * FROM Roles WHERE RoleId = ?", "i", $id)
                ->get_result()
                ->fetch_assoc()
        );
    }

    public function update($entity): void
    {
        $this->query(
            "UPDATE Roles SET Name = ? WHERE RoleId = ?",
            "si",
            $entity->name,
            $entity->roleId
        );
    }

    public function delete($id): void
    {
        $this->query(
            "DELETE FROM Roles WHERE RoleId = ?",
            "i",
            $id
        );
    }

    public function create($entity): void
    {
        $this->query(
            "INSERT INTO Roles (Name) VALUES (?)",
            "s",
            $entity->name
        );
    }
}

class RoleBuilder
{
    private array $associative = [];

    public function withName(string $name): RoleBuilder
    {
        $this->associative["Name"] = $name;

        return $this;
    }

    public function build(): Role
    {
        return new Role($this->associative);
    }
}
