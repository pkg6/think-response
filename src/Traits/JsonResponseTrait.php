<?php

namespace Tp5er\Think\Response\Traits;

use think\contract\Arrayable;
use think\helper\Arr;
use think\Paginator;
use think\response\Json;

trait JsonResponseTrait
{
    public function accepted($data = [], string $message = '', string $location = '')
    {
        $response = $this->success($data, $message, 202);
        if ($location) {
            $response->header(['Location' => $location]);
        }

        return $response;
    }

    public function created($data = [], string $message = '', string $location = '')
    {
        $response = $this->success($data, $message, 201);
        if ($location) {
            $response->header(['Location' => $location]);
        }

        return $response;
    }

    public function noContent(string $message = '')
    {
        return $this->success([], $message, 204);
    }

    public function ok(string $message = '', int $code = 200, array $headers = [], int $option = 0)
    {
        return $this->success([], $message, $code, $headers, $option);
    }

    public function localize(int $code = 200, array $headers = [], int $option = 0)
    {
        return $this->ok('', $code, $headers, $option);
    }

    public function errorBadRequest(string $message = '')
    {
        $this->fail($message, 400);
    }

    public function errorUnauthorized(string $message = '')
    {
        $this->fail($message, 401);
    }

    public function errorForbidden(string $message = '')
    {
        $this->fail($message, 403);
    }

    public function errorNotFound(string $message = '')
    {
        $this->fail($message, 404);
    }

    public function errorMethodNotAllowed(string $message = '')
    {
        $this->fail($message, 405);
    }

    public function errorInternal(string $message = '')
    {
        $this->fail($message);
    }

    public function fail(string $message = '', int $code = 500, $errors = null, array $header = [], int $options = 0)
    {
        $response = $this->formatter->response(
            $this->formatter->data(null, $message, $code, $errors),
            config('response.error_code') ?: $code,
            $header,
            $options
        );
        return $response;
    }

    /**
     * Return a success response.
     *
     * @param array|mixed $data
     * @param string $message
     * @param int $code
     * @param array $headers
     * @param int $option
     * @return Json
     */
    public function success($data = [], string $message = '', int $code = 200, array $headers = [], int $option = 0)
    {
        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        }
        return $this->formatter->response($this->formatter->data(Arr::wrap($data), $message, $code), $code, $headers, $option);
    }

}
