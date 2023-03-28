<?php

declare(strict_types=1);

namespace DoctrineORM;

use Doctrine\ORM\EntityManager;

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
                EntityManager::class => Service\EntityManagerFactory::class,
            ],
        ];
    }
}