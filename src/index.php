<?php

require "presentation/FrontController.php";

use RoboticsWorld\Presentation\FrontController;

(function () {
    session_start();
    $page = new FrontController();
    $page->load();
})();
