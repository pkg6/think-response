<?php

namespace Tp5er\Think\Response\Enum\Exceptions;

use Exception;

class InvalidMethodException extends Exception
{
    public function __construct($invalidMethod, $enumClass)
    {
        $enumClassName = class_basename($enumClass);

        parent::__construct("Cannot found $invalidMethod method on $enumClassName class.", 405);
    }
}
