<?php

declare(strict_types=1);

namespace App\Models;

require_once "app/Models/AbstractModel.php";

class Status extends AbstractModel
{
    public int $statusId;
    public string $name;
    public bool $isRemoved;

    /**
     * Status constructor.
     * @param array $associative
     * @example new Status(array("StatusId" => 0, "Name" => "Welcome"))
     */
    public function __construct(array $associative)
    {
        parent::__construct();
        $this->statusId = (int)$associative["StatusId"] ?? 0;
        $this->name = $associative["Name"] ?? "";
        $this->isRemoved = (bool)$associative["IsRemoved"] ?? false;
    }

    public function create($entity): void
    {
        $this->query(
            "INSERT INTO Statuses (Name) VALUES (?)",
            "s",
            $entity->name
        );
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM Statuses";

        return $this->mapFrom($query, Status::class);
    }

    public function getById($id): Status
    {
        return new Status(
            $this->query("SELECT * FROM Statuses WHERE StatusId = ?", "i", $id)
                ->get_result()
                ->fetch_assoc()
        );
    }

    public function update($entity): void
    {
        $this->query(
            "UPDATE Statuses SET Name = ? WHERE StatusId = ?",
            "si",
            $entity->name,
            $entity->statusId
        );
    }

    public function delete($id): void
    {
        $this->query(
            "DELETE FROM Statuses WHERE StatusId = ?",
            "i",
            $id
        );
    }
}

class StatusBuilder
{
    private array $associative = [];

    public function withId(int $id)
    {
        $this->associative["StatusId"] = $id;

        return $this;
    }

    public function withName(string $name): StatusBuilder
    {
        $this->associative["Name"] = $name;

        return $this;
    }

    public function build(): Status
    {
        return new Status($this->associative);
    }
}
