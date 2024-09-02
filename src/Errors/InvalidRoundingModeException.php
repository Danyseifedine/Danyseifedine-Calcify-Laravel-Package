<?php

namespace Danyseif\Calcify\Errors;

use Exception;

class InvalidRoundingModeException extends Exception
{
    protected $message = "Invalid rounding mode. Use 'ceil' or 'floor'.";
}
