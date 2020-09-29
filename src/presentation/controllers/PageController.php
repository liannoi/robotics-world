<?php

namespace RoboticsWorld\Presentation\Controllers;

class PageController
{
    private $user;
    private $names;
    private $title;
    private $id;
    private $content;
    private $template;

    public function __construct()
    {
        $this->id = $this->get_id();
        $this->user = $this->get_user();
        $this->names = require "presentation/names.php";
        $this->title = $this->names[$this->id];
        $this->content = "presentation/pages/{$this->id}.php";
        $this->template = "presentation/components/app/app.component.php";
    }

    public function load()
    {
        include $this->template;
    }

    private function get_id(): string
    {
        if (isset($_GET["id"])) {
            return $_GET["id"];
        }

        return "main";
    }

    private function get_user()
    {
        if (isset($_SESSION["user"])) {
            return $_SESSION["user"];
        } elseif (isset($_COOKIE["user"])) {
            return $_COOKIE["user"];
        }

        return "Гость";
    }
}
