<?php

declare(strict_types=1);

namespace App\Rules;

require_once "app/Exceptions/ValidationException.php";

use App\Exceptions\ValidationException;

abstract class  AbstractValidator
{
    abstract public function email(string $input): bool;

    abstract public function username(string $input): bool;

    abstract public function password(string $input, string $repeat): bool;

    protected function validate(string $pattern, string $input, string $message = "Invalid values entered.")
    {
        if (preg_match_all($pattern, $input)) {
            return true;
        }

        throw new ValidationException($message);
    }
}
