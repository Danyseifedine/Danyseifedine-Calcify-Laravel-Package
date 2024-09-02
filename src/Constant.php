<?php

namespace Danyseif\Calcify;

class Constant

{
    public const TYPE_INT = 'int';
    public const TYPE_FLOAT = 'float';
    public const TYPE_STRING = 'string';
    public const TYPE_ARRAY = 'array';
    public const TYPE_OBJECT = 'object';
    public const TYPE_NULL = 'null';
    public const TYPE_RESOURCE = 'resource';
    public const TYPE_CALLABLE = 'callable';
    public const TYPE_ITERABLE = 'iterable';
    public const TYPE_MIXED = 'mixed';
    public const TYPE_VOID = 'void';

    public const TYPE_TRUE = 'true';
    public const TYPE_FALSE = 'false';

    public const ROUNDING_CEIL = 'ceil';
    public const ROUNDING_FLOOR = 'floor';
    public const ROUNDING_ROUND = 'round';

    public const DEFAULT_DECIMAL_PLACES = 2;
    public const DEFAULT_INITIAL_VALUE = 0;
    public const PERCENTAGE_DIVISOR = 100;
    public const DEFAULT_ROUNDED = false;
    public const DEFAULT_ROUNDING_MODE = self::ROUNDING_FLOOR;
}
