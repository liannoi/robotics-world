<?php

declare(strict_types=1);

namespace App\Models;

require_once "app/Models/AbstractModel.php";

class User extends AbstractModel
{
    public int $userId;
    public string $username;
    public string $email;
    public bool $isEmailVerified;
    public string $password;
    public int $statusId;
    public string $signUpDate;
    public bool $isRemoved;

    public function __construct(array $associative)
    {
        parent::__construct();
        $this->userId = (int)$associative["UserId"] ?? 0;
        $this->username = $associative["Username"] ?? "";
        $this->email = $associative["Email"] ?? "";
        $this->isEmailVerified = (bool)$associative["IsEmailVerified"] ?? false;
        $this->password = $associative["Password"] ?? "";
        $this->statusId = (int)$associative["StatusId"] ?? 0;
        $this->signUpDate = $associative["SignUpDate"] ?? "";
        $this->isRemoved = (bool)$associative["IsRemoved"] ?? false;
    }

    public function create($entity): void
    {
        $query = "INSERT INTO Users (Username, Email, Password, StatusId)";
        $query .= " VALUES (?, ?, ?, ?)";

        $this->query(
            $query,
            "sssi",
            $entity->username,
            $entity->email,
            $entity->password,
            $entity->statusId
        );
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM Users";

        return $this->mapFrom($query, User::class);
    }

    public function getById($id)
    {
        return new User(
            $this->query("SELECT * FROM Users WHERE UserId = ?", "i", $id)
                ->get_result()
                ->fetch_assoc()
        );
    }

    public function update($entity): void
    {
        $this->query(
            "UPDATE Users SET Username = ? WHERE UserId = ?",
            "si",
            $entity->username,
            $entity->userId
        );
    }

    public function delete($id): void
    {
        $this->query(
            "DELETE FROM Users WHERE UserId = ?",
            "i",
            $id
        );
    }
}

class UserBuilder
{
    private array $associative = [];

    public function withUsername(string $username): UserBuilder
    {
        $this->associative["Username"] = $username;

        return $this;
    }

    public function withEmail(string $email): UserBuilder
    {
        $this->associative["Email"] = $email;

        return $this;
    }

    public function withPassword(string $password): UserBuilder
    {
        $this->associative["Password"] = hash("sha256", $password);

        return $this;
    }

    public function withStatus(int $statusId): UserBuilder
    {
        $this->associative["StatusId"] = $statusId;

        return $this;
    }

    public function build(): User
    {
        return new User($this->associative);
    }
}
