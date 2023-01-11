<?php

declare(strict_types=1);

namespace App\Handler;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
                PingHandler::class => PingHandler::class,
            ],
            'factories'  => [
                HomePageHandler::class => HomePageHandlerFactory::class,
            ],
        ];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app_common'  => [__DIR__ . '/../../templates/common'],
                'app_layout' => [__DIR__ . '/../../templates/layout'],
            ],
        ];
    }
}
