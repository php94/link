<?php

declare(strict_types=1);

namespace App\Php94\Link\Http;

use PHP94\Db;
use PHP94\Request;
use PHP94\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Jump implements RequestHandlerInterface
{
    public function handle(
        ServerRequestInterface $request
    ): ResponseInterface {
        $method = strtolower($request->getMethod());
        if (in_array($method, ['get', 'put', 'post', 'delete', 'head', 'patch', 'options']) && is_callable([$this, $method])) {
            $resp = call_user_func([$this, $method]);
            if (is_a($resp, ResponseInterface::class)) {
                return $resp;
            }
            return Response::html((string)$resp);
        } else {
            return Response::error('不支持该请求');
        }
    }

    public function get()
    {
        if (!$url = Db::get('php94_link_url', '*', [
            'key' => Request::get('key'),
        ])) {
            return Response::error('地址不存在~');
        }
        return Response::redirect($url['url']);
    }
}
