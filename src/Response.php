<?php

namespace Tp5er\Think\Response;

use Tp5er\Think\Response\Contracts\Format;
use Tp5er\Think\Response\Traits\JsonResponseTrait;

class Response
{
    use JsonResponseTrait;

    protected $formatter;

    public function __construct(Format $format)
    {
        $this->formatter = $format;
    }
}
