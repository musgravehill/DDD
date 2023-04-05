<?php

declare(strict_types=1);

namespace Presentation\Web\Middleware\Csrf;

use Psr\Http\Message\ServerRequestInterface;
use Presentation\Web\Middleware\Session\SessionProviderInterface;
use Psr\Container\ContainerInterface;

class CsrfGuardFactory
{
    public function __invoke(ContainerInterface $container): CsrfGuardInterface
    {
        $sessionProvider = $container->has(SessionProviderInterface::class)
            ? $container->get(SessionProviderInterface::class)
            : null;
        assert($sessionProvider instanceof SessionProviderInterface);

        if (!$sessionProvider instanceof SessionProviderInterface) {
            throw new \LogicException('Error '.static::class);
        }

        return new CsrfGuard($sessionProvider);
    }
}
