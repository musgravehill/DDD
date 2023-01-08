<?php

declare(strict_types=1);

namespace App\Middleware;

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
class ValidatorMiddleware implements MiddlewareInterface
{

        public function __construct(private $dtoRequestFactory)
        {
        }

        public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
        {
                $routeResult = $request->getAttribute(RouteResult::class, null);
                $routeName = $routeResult?->getMatchedRouteName();
                $dto =  $this->dtoRequestFactory->getDto($routeName);
                $request = $request->withAttribute('DtoForRoute', $dto);

                //get errors from $dto & stop request propogation in pipeline 

                return $handler->handle($request);

                //return $response->withHeader('DtoForRoute', $routeName);
        }
}
