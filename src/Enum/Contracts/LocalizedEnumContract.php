<?php

namespace Tp5er\Think\Response\Enum\Contracts;

interface LocalizedEnumContract
{
    /**
     * Get the default localization key.
     *
     * @return string
     */
    public static function getLocalizationKey();
}
