<?php

declare(strict_types=1);

namespace App\Csrf;

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
                CsrfGuardInterface::class => CsrfGuardFactory::class,
                CsrfMiddleware::class => CsrfMiddlewareFactory::class,
            ],
        ];
    }
}
