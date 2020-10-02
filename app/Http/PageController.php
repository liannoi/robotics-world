<?php

declare(strict_types=1);

namespace App\Http;

class PageController
{
    private string $username;
    private array $names;
    private string $title;
    private string $id;
    private string $content;
    private string $template;

    public function __construct()
    {
        $this->id = $this->get_id();
        $this->username = $this->get_user();
        $this->setupNames();
        $this->title = $this->names[$this->id];
        $this->content = "resources/layout/{$this->id}.component.php";
        $this->template = "resources/layout/app.component.php";
    }

    private function get_id(): string
    {
        $id = $_GET["id"];
        $this->setupNames();

        if (!isset($id)) {
            return "main";
        } elseif (!array_key_exists($id, $this->names)) {
            return "status_404_not_found";
        }

        return $id;
    }

    private function setupNames(): void
    {
        $this->names = require "resources/values-en/names.php";
    }

    private function get_user(): string
    {
        $sessionUser = $_SESSION["user"];
        $cookieUser = $_COOKIE["user"];

        if (isset($sessionUser)) {
            return $sessionUser;
        } elseif ($cookieUser) {
            return $cookieUser;
        }

        return "";
    }

    public function load(): void
    {
        include $this->template;
    }
}
