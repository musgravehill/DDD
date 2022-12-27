<?php

declare(strict_types=1);

namespace App\Csrf;

use Psr\Http\Message\ServerRequestInterface;
use App\Session\SessionProviderInterface;
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
            throw new \LogicException('No SessionProviderInterface');
        }

        return new CsrfGuard($sessionProvider);
    }
}
