<?php

namespace Tp5er\Think\Response\Enum\Exceptions;

use Exception;

class InvalidEnumValueException extends Exception
{
    public function __construct($invalidValue, $enumClass)
    {
        $invalidValueType = gettype($invalidValue);
        $enumValues = implode(', ', $enumClass::getValues());
        $enumClassName = class_basename($enumClass);

        parent::__construct("Cannot construct an instance of $enumClassName using the value ($invalidValueType) `$invalidValue`. Possible values are [$enumValues].");
    }
}
