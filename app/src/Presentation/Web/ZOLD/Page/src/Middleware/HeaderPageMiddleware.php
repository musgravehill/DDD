<?php

declare(strict_types=1);

namespace Page\Middleware;

use Mezzio\Router\RouteResult;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Test middleware.
 *
 * add header  
 */
class HeaderPageMiddleware implements MiddlewareInterface
{
        public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
        {
                $routeResult = $request->getAttribute(RouteResult::class, false);
                $response = $handler->handle($request);
                $info =  $routeResult->getMatchedRouteName();
                return $response->withHeader('MyHeader', $info);
        }
}
