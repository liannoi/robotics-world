<?php

declare(strict_types=1);

namespace RoboticsWorld\Application\Common\Storage;

interface RepositoryInterface
{
    public function create($entity): void;

    public function getAll(): array;

    public function getById($id);

    public function update($entity): void;

    public function delete($id): void;
}
