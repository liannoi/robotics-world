<?php

declare(strict_types=1);

namespace App\Models;

require_once "app/Models/ActiveRecord.php";

class Role extends ActiveRecord
{
    public int $roleId;
    public string $name;
    public bool $isRemoved;

    public function __construct(array $associative = array())
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

    public function getById(): Role
    {
        $query = "SELECT * FROM Roles WHERE RoleId = ?";

        return new Role(
            $this->query($query, "i", $this->roleId)
                ->get_result()
                ->fetch_assoc()
        );
    }

    public function update(): void
    {
        $query = "UPDATE Roles SET Name = ? WHERE RoleId = ?";

        $this->query($query, "si", $this->name, $this->roleId);
    }

    public function delete(): void
    {
        $query = "DELETE FROM Roles WHERE RoleId = ?";

        $this->query($query, "i", $this->roleId);
    }

    public function create(): void
    {
        $query = "INSERT INTO Roles (Name) VALUES (?)";

        $this->query($query, "s", $this->name);
    }

    public function __toString(): string
    {
        return $this->name;
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
