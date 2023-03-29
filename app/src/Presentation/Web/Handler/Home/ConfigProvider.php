<?php

declare(strict_types=1);

namespace Presentation\Web\Handler\Home;

use Presentation\Web\Handler\Home\Handler\HomePageHandler;
use Presentation\Web\Handler\Home\Handler\HomePageHandlerFactory;
use Presentation\Web\Handler\Home\Handler\PingHandler;

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
                'view'  => [__DIR__ . '/../view'],                
            ],
        ];
    }
}
