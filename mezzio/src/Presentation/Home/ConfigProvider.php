<?php

declare(strict_types=1);

namespace Presentation\Home;

use Presentation\Home\Handler\HomePageHandlerFactory;
use Presentation\Home\Handler\PingHandler;

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
                'view'  => [__DIR__ . '/../../templates/view'],
                'layout' => [__DIR__ . '/../../templates/layout'],
            ],
        ];
    }
}
