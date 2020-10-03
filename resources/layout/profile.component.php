<?php

require_once "app/Models/Status.php";
require_once "app/Models/UserRole.php";

use App\Models\StatusBuilder;
use App\Models\UserRoleBuilder;

if (!$this->isUserAuthenticated()) { ?>
    <script>
      window.location.replace('status-forbidden');
    </script>
    <?
}

$status = (new StatusBuilder())->withId($this->user->statusId)->build()->getById();
$userRoles = (new UserRoleBuilder())->withUser($this->user->userId)->build()->getRolesById();
?>

<div class="row mt-4">
    <div class="col-sm-12">
        <h1>Profile</h1>
        <hr>
    </div>
</div>

<div class="row mt-1">
    <div class="col-sm-12">
        <p>On this page the user can view and customize their profile.</p>
    </div>
</div>

<div class="row mt-1 mb-5">
    <div class="col-sm-12">
        <table class="table border table-striped table-sm table-responsive-sm">
            <thead class="thead-light table-bordered">
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Status</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row"><?= $this->user->username ?></th>
                <td><?= $status->name ?></td>
                <td><?= $this->user->email ?> (<?= $this->user->isEmailVerified ? "+" : "-" ?>)</td>
                <td><?= implode(", ", $userRoles); ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
