<?php

declare(strict_types=1);

namespace RoboticsWorld\Presentation\Controllers;

require "domain/entities/User.php";

use RoboticsWorld\Domain\Entities\User;

class PageController
{
    private User $user;
    private array $names;
    private string $title;
    private string $id;
    private string $content;
    private string $template;

    public function __construct()
    {
        $this->id = $this->get_id();
        $this->user = $this->get_user();
        $this->names = require "presentation/common/resources/names.php";
        $this->title = $this->names[$this->id];
        $this->content = "presentation/components/{$this->id}/{$this->id}.component.php";
        $this->template = "presentation/common/components/app/app.component.php";
    }

    private function get_id(): string
    {
        $id = $_GET["id"];
        $this->names = require "presentation/common/resources/names.php";

        if (!isset($id)) {
            return "main";
        } elseif (!array_key_exists($id, $this->names)) {
            return "status_404_not_found";
        }

        return $id;
    }

    private function get_user(): User
    {
        $sessionUser = $_SESSION["user"];
        $cookieUser = $_COOKIE["user"];

        if (isset($sessionUser)) {
            return $sessionUser;
        } elseif ($cookieUser) {
            return $cookieUser;
        }

        return new User("Guest", false);
    }

    public function load(): void
    {
        include $this->template;
    }
}
