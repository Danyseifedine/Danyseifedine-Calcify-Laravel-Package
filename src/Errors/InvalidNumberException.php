<?php

namespace Danyseif\Calcify\Errors;

use Exception;

class InvalidNumberException extends Exception
{
    protected $message = "Value must be a number or numeric string.";
}
