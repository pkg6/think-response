<?php
declare (strict_types=1);

namespace Tp5er\Think\Response\Http\Middleware;

use think\helper\Str;
use think\Response;

class SetAcceptHeader
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure $next
     * @return Response
     */
    public function handle($request, \Closure $next, string $type = 'json')
    {
        Str::contains($request->header('Accept'), $contentType = "application/$type") or
        $request->headers->set('Accept', $contentType);
        return $next($request);
    }
}
