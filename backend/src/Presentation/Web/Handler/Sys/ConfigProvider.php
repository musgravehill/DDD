<?php

declare(strict_types=1);

namespace Presentation\Web\Handler\Sys;

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
        return [];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'sys_layout' => [__DIR__ . '/../../layout'],
                'sys_view' => [__DIR__ . '/view'],
            ],
        ];
    }
}
