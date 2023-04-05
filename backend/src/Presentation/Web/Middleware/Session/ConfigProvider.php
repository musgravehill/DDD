<?php

declare(strict_types=1);

namespace Presentation\Web\Middleware\Session;

use Presentation\Web\Middleware\Session\PSR7SessionStorageless\SessionMiddlewareFactory;
use Presentation\Web\Middleware\Session\PSR7SessionStorageless\SessionProviderFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories'  => [
                SessionProviderInterface::class => SessionProviderFactory::class,
                SessionMiddlewareInterface::class => SessionMiddlewareFactory::class, //TODO prod-dev factories
            ],
        ];
    }
}
