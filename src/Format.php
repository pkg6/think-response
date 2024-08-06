<?php

namespace Tp5er\Think\Response;

use think\Container;
use think\helper\Arr;
use think\response\Json;

class Format implements \Tp5er\Think\Response\Contracts\Format
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @param $config
     */
    public function __construct($config = [])
    {
        $this->config = $config;
    }

    /**
     * @param array|null $data
     * @param string|null $message
     * @param int $code
     * @param $errors
     * @return array
     */
    public function data(?array $data, ?string $message, int $code, $errors = null): array
    {
        return $this->formatDataFields([
            'status'  => $this->formatStatus($code),
            'code'    => $code,
            'message' => $this->formatMessage($code, $message),
            'data'    => $data ?: (object)$data,
            'error'   => $errors ?: (object)[],
        ], $this->config);
    }

    /**
     * @param $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return Json
     */
    public function response($data = [], int $status = 200, array $headers = [], int $options = JSON_ERROR_NONE): Json
    {
        $option['json_encode_param'] = $options;
        return Container::getInstance()->invokeClass(Json::class, [$data, $status])->header($headers)->options($option);
    }

    /**
     * @param int $code
     * @param string|null $message
     * @return string|null
     */
    protected function formatMessage(int $code, ?string $message): ?string
    {
        if (!$message && class_exists($enumClass = \config('response.enum'))) {
            $message = $enumClass::fromValue($code)->description;
        }
        return $message;
    }

    /**
     * Http status code.
     *
     * @param $code
     * @return int
     */
    protected function formatStatusCode($code): int
    {
        return (int)substr($code, 0, 3);
    }

    /**
     * @param int $code
     * @return string
     */
    protected function formatStatus(int $code): string
    {
        $statusCode = $this->formatStatusCode($code);
        if ($statusCode >= 400 && $statusCode <= 499) {
            $status = 'error';
        } elseif ($statusCode >= 500 && $statusCode <= 599) {
            $status = 'fail';
        } else {
            $status = 'success';
        }
        return $status;
    }

    /**
     * @param array $responseData
     * @param array $dataFieldsConfig
     * @return array
     */
    protected function formatDataFields(array $responseData, array $dataFieldsConfig = []): array
    {
        if (empty($dataFieldsConfig)) {
            return $responseData;
        }

        foreach ($responseData as $field => $value) {
            $fieldConfig = Arr::get($dataFieldsConfig, $field);
            if (is_null($fieldConfig)) {
                continue;
            }
            if ($value && is_array($value) && in_array($field, ['data', 'meta', 'pagination', 'links'])) {
                $value = $this->formatDataFields($value, Arr::get($dataFieldsConfig, "{$field}.fields", []));
            }
            $alias = $fieldConfig['alias'] ?? $field;
            $show  = $fieldConfig['show'] ?? true;
            $map   = $fieldConfig['map'] ?? null;
            unset($responseData[$field]);

            if ($show) {
                $responseData[$alias] = $map[$value] ?? $value;
            }
        }

        return $responseData;
    }
}
