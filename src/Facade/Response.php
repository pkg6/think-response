<?php

namespace Tp5er\Think\Response\Facade;

use think\Facade;

class Response extends Facade
{
    protected static function getFacadeClass()
    {
        return \Tp5er\Think\Response\Response::class;
    }
}
