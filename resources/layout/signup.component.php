<?php

declare(strict_types=1);

require_once "app/Models/Role.php";
require_once "app/Models/Status.php";

use App\Http\RoleBuilder;
use App\Http\StatusBuilder;

$statuses = (new StatusBuilder())->build()->getAll();
$roles = (new RoleBuilder())->build()->getAll();
?>

<div class="row mt-5 mb-5">
    <div class="col-md-12">
        <h3 class="text-center">Create your account</h3>
    </div>
</div>

<div class="row mb-5 d-flex justify-content-center align-items-center">
    <div class="col-sm-4">
        <form action="../../index.php" method="post">
            <div class="form-group">
                <label for="user_username" class="font-weight-bold">Username</label>

                <input type="text" class="form-control" id="user_username" name="user[username]" required>
            </div>

            <div class="form-group">
                <label for="user_email" class="font-weight-bold">Email address</label>

                <input type="email" class="form-control" id="user_email" name="user[email]" required>
            </div>

            <div class="form-group">
                <label for="user_password" class="font-weight-bold">Password</label>

                <input type="password" class="form-control" id="user_password" name="user[password]" required>
            </div>

            <div class="form-group">
                <label for="user_repeat_password" class="font-weight-bold">Repeat password</label>

                <input type="password" class="form-control" id="user_repeat_password" name="user[repeat_password]"
                       required>
            </div>

            <div class="form-group">
                <label for="user_status" class="font-weight-bold">Status</label>

                <select class="form-control" id="user_status">
                    <?
                    foreach ($statuses as $status) { ?>
                        <option><?= $status->name ?></option>
                        <?
                    } ?>
                </select>
            </div>

            <div class="form-group mb-5">
                <label for="user_roles" class="font-weight-bold">Roles</label>
                <select multiple class="form-control" id="user_roles">
                    <?
                    foreach ($roles as $role) { ?>
                        <option><?= $role->name ?></option>
                        <?
                    } ?>
                </select>
            </div>

            <div class="form-row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary w-100 p-3 font-weight-bold">Create account</button>
                </div>
            </div>
        </form>
    </div>
</div>
