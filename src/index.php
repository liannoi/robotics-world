<?php

require "presentation/controllers/PageController.php";

use RoboticsWorld\Presentation\Controllers\PageController;

(function () {
    session_start();
    $page = new PageController();
    $page->load();
})();
