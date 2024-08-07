<?php

namespace Tp5er\Think\Response;

class Service extends \think\Service
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $formatter = $this->app->config->get('response.format.0', \Tp5er\Think\Response\Format::class);
        $config    = $this->app->config->get('response.format.1', []);
        if (is_string($formatter) && class_exists($formatter)) {
            $this->app->bind(Contracts\Format::class, function () use ($formatter, $config) {
                return new $formatter($config);
            });
        }
    }
}
