<?php

namespace Tp5er\Think\Response\Contracts;

use think\response\Json;

interface Format
{
    public function data(?array $data, ?string $message, int $code, $errors = null): array;
    public function response($data = [], int $status = 200, array $headers = [], int $options = JSON_ERROR_NONE): Json;
}
