<?php

declare(strict_types=1);

namespace App\Rules;

use App\Exceptions\ValidationException;

require_once "app/Rules/AbstractValidator.php";

class RegexValidator extends AbstractValidator
{
    public function email(string $input): bool
    {
        $pattern = '/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/m';

        try {
            return $this->validate($pattern, $input, "Email doesn't match the security policy.");
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    public function username(string $input): bool
    {
        $pattern = "/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/";

        try {
            return $this->validate($pattern, $input, "Username doesn't match the security policy.");
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    public function password(string $input, string $repeat): bool
    {
        if ($input !== $repeat) {
            throw new ValidationException("The passwords entered don't match.");
        }

        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

        try {
            return $this->validate($pattern, $input, "Password doesn't match the security policy.");
        } catch (ValidationException $e) {
            throw $e;
        }
    }
}
