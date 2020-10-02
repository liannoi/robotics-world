<?php

declare(strict_types=1);

namespace RoboticsWorld\Application\Storage\Statutes;

require_once "application/common/storage/AbstractRepository.php";

use RoboticsWorld\Application\Common\Storage\AbstractRepository;
use RoboticsWorld\Domain\Entities\Status;

class StatusesRepository extends AbstractRepository
{
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

        return $this->context->mapFrom($query, Status::class);
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
