<?php

declare(strict_types=1);

namespace App\Models;

require_once "app/Models/ActiveRecord.php";

class Status extends ActiveRecord
{
    public int $statusId;
    public string $name;
    public bool $isRemoved;

    /**
     * Status constructor.
     * @param array $associative
     * @example new Status(array("StatusId" => 0, "Name" => "Welcome"))
     */
    public function __construct(array $associative = array())
    {
        parent::__construct();
        $this->statusId = (int)$associative["StatusId"] ?? 0;
        $this->name = $associative["Name"] ?? "";
        $this->isRemoved = (bool)$associative["IsRemoved"] ?? false;
    }

    public function create(): void
    {
        $query = "INSERT INTO Statuses (Name) VALUES (?)";

        $this->query($query, "s", $this->name);
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM Statuses";

        return $this->mapFrom($query, Status::class);
    }

    public function getById(): Status
    {
        $query = "SELECT * FROM Statuses WHERE StatusId = ?";

        return new Status(
            $this->query($query, "i", $this->statusId)
                ->get_result()
                ->fetch_assoc()
        );
    }

    public function update(): void
    {
        $query = "UPDATE Statuses SET Name = ? WHERE StatusId = ?";

        $this->query($query, "si", $this->name, $this->statusId);
    }

    public function delete(): void
    {
        $query = "DELETE FROM Statuses WHERE StatusId = ?";

        $this->query($query, "i", $this->statusId);
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
