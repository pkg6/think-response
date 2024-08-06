<?php

return [
    /*
       |--------------------------------------------------------------------------
       | Set the http status code when the response fails
       |--------------------------------------------------------------------------
       |
       | the reference options are false, 200, 500
       |
       | false, stricter http status codes such as 404, 401, 403, 500, etc. will be returned
       | 200, All failed responses will also return a 200 status code
       | 500, All failed responses return a 500 status code
       */

    'error_code' => false,


    //You can set some attributes (eg:code/message/header/options) for the exception, and it will override the default attributes of the exception
    'exception'  => [
        \think\exception\ValidateException::class      => [
            'code' => 422,
        ],
        \think\exception\ClassNotFoundException::class => [
            'message' => '',
        ],
        \think\exception\FuncNotFoundException::class  => [
            'message' => '',
        ],
    ],
    'format'     => [
        \Tp5er\Think\Response\Format::class,
        []
    ]

];
