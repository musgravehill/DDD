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
        $response = $handler->handle($request);

        $session = (new \App\PersistenceStorage\PersistenceStorageAdapter)($request);
        $session->set('counter', $session->get('counter', 0) + 10);

        return $response->withHeader('MyHeader', 'Mus');
    }
}
