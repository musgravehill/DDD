<?php

declare(strict_types=1);

namespace Presentation\Web\Middleware\Authentication;

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
                AuthenticationMiddleware::class => AuthenticationMiddlewareFactory::class,
                //AuthenticationInterface::class =>
                UserInterface::class => UserFactory::class,
            ],
        ];
    }
}
