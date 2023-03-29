<?php

declare(strict_types=1);

namespace App\Session;

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
                SessionProviderInterface::class => PSR7SessionStorageless\SessionProviderFactory::class,
                SessionMiddlewareInterface::class => PSR7SessionStorageless\SessionMiddlewareFactory::class, //TODO prod-dev factories
            ],
        ];
    }
}
