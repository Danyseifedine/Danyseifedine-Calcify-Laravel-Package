<?php

namespace Danyseif\Calcify\Errors;

use Exception;

class DivisionByZeroException extends Exception
{
    protected $message = 'Division by zero';
}
