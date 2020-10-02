<?php

declare(strict_types=1);

namespace RoboticsWorld\Presentation\Components\Signup;

require_once "application/storage/statutes/StatusesRepository.php";
require_once "infrastructure/persistence/RoboticsWorldContext.php";

use RoboticsWorld\Application\Storage\Statutes\StatusesRepository;
use RoboticsWorld\Infrastructure\Persistence\RoboticsWorldContext;

$repository = new StatusesRepository(new RoboticsWorldContext());
$statuses = $repository->getAll();

// $repository = new StatusesRepository(new RoboticsWorldContext());
//$status = $repository->getAll();
//echo $status[0]->statusId;

// $status = (new StatusBuilder())->withName("Hello")->build();
// $repository->create($status);

// $repository->delete(15);

/*$status = (new StatusBuilder())->withId(1)
    ->withName("Available")
    ->build();

$repository->update($status);*/
?>

<div class="row mt-5 mb-5">
    <div class="col-md-12">
        <h3 class="text-center">Create your account</h3>
    </div>
</div>

<div class="row mb-5 d-flex justify-content-center align-items-center">
    <div class="col-sm-4">
        <form action="sign_up_result" method="post">
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
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
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
