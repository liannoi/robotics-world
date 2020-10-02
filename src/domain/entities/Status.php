<?php

declare(strict_types=1);

namespace RoboticsWorld\Domain\Entities;

class Status
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
        $this->statusId = (int)$associative["StatusId"] ?? 0;
        $this->name = $associative["Name"] ?? "";
        $this->isRemoved = (bool)$associative["IsRemoved"] ?? false;
    }
}

class StatusBuilder
{
    private array $associative;

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
