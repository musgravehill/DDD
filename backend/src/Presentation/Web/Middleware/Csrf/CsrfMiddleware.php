<?php

declare(strict_types=1);

namespace Presentation\Web\Middleware\Csrf;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Create a CSRF guard and inject it as a request attribute.
 *
 * Uses the provided CsrfGuardFactoryInterface implementation to create a
 * CsrfGuardInterface instance and inject it into the request provided to the
 * delegate.
 *
 * Later middleware can then access the CsrfGuardInterface instance in order to
 * either generate or validate a token.
 */
class CsrfMiddleware implements MiddlewareInterface
{
    public const GUARD_ATTRIBUTE = 'csrf';

    public function __construct(
        private CsrfGuardInterface $guard,
        private string $attributeKey = self::GUARD_ATTRIBUTE
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->guard->start($request);
        
        return $handler->handle(
            $request->withAttribute($this->attributeKey, $this->guard)
        );
    }
}
