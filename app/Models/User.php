<?php

declare(strict_types=1);

namespace App\Models;

use App\Exceptions\AuthenticationException;

require_once "app/Models/ActiveRecord.php";

class User extends ActiveRecord
{
    public int $userId;
    public string $username;
    public string $email;
    public bool $isEmailVerified;
    public string $password;
    public int $statusId;
    public string $signUpDate;
    public bool $isRemoved;

    public function __construct(array $associative = array())
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

    public function create(): void
    {
        $query = "INSERT INTO Users (Username, Email, Password, StatusId)";
        $query .= " VALUES (?, ?, ?, ?)";

        $this->query(
            $query,
            "sssi",
            $this->username,
            $this->email,
            $this->password,
            $this->statusId
        );
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM Users";

        return $this->mapFrom($query, User::class);
    }

    public function getById(): User
    {
        $query = "SELECT * FROM Users WHERE UserId = ?";

        return new User(
            $this->query($query, "i", $this->userId)
                ->get_result()
                ->fetch_assoc()
        );
    }

    public function update(): void
    {
        $query = "UPDATE Users SET Username = ? WHERE UserId = ?";

        $this->query($query, "si", $this->username, $this->userId);
    }

    public function delete(): void
    {
        $query = "DELETE FROM Users WHERE UserId = ?";

        $this->query($query, "i", $this->userId);
    }

    public function auth(): User
    {
        $query = "SELECT U.UserId, U.Username, U.StatusId, U.Email, U.IsEmailVerified, U.Email FROM Users AS U";
        $query .= " WHERE Username = ? AND Password = ?";

        $associative = $this->query($query, "ss", $this->username, $this->password)
            ->get_result()
            ->fetch_assoc();

        if ($associative == null) {
            throw new AuthenticationException();
        }

        return new User($associative);
    }
}

class UserBuilder
{
    private array $associative = [];

    public function withId(int $id): UserBuilder
    {
        $this->associative["UserId"] = $id;

        return $this;
    }

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
