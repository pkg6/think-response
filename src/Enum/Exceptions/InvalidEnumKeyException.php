<?php

namespace Tp5er\Think\Response\Enum\Exceptions;

use Exception;

class InvalidEnumKeyException extends Exception
{
    public function __construct($invalidKey, $enumClass)
    {
        $invalidKeyType = gettype($invalidKey);
        $enumKeys = implode(', ', $enumClass::getKeys());
        $enumClassName = class_basename($enumClass);

        parent::__construct("Cannot construct an instance of $enumClassName using the key ($invalidKeyType) `$invalidKey`. Possible keys are [$enumKeys].");
    }
}
