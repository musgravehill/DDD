<?php

declare(strict_types=1);

namespace Presentation\Web\Middleware\Csrf;

use Psr\Container\ContainerInterface;
use Presentation\Web\Middleware\Csrf\CsrfGuardInterface;

class CsrfMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): CsrfMiddleware
    {
        /** @var CsrfGuardInterface */
        $guard = $container->get(CsrfGuardInterface::class);

        return new CsrfMiddleware($guard);
    }
}
