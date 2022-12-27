<?php

declare(strict_types=1);

namespace App\Session;

//

use App\Session\PSR7SessionStorageless\SessionProvider;
use Psr\Container\ContainerInterface;
use App\Session\SessionProviderInterface;

class SessionProviderFactory
{
    public function __invoke(ContainerInterface $container): SessionProviderInterface
    {
        return new SessionProvider();
    }
}
