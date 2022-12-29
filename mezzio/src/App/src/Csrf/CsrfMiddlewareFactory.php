<?php

declare(strict_types=1);

namespace App\Csrf;

use Psr\Container\ContainerInterface;
use App\Csrf\CsrfGuardInterface;

class CsrfMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): CsrfMiddleware
    {
        /** @var CsrfGuardInterface */
        $guard = $container->get(CsrfGuardInterface::class);

        return new CsrfMiddleware($guard);
    }
}
