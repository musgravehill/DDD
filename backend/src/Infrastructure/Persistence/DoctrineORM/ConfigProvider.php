<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\DoctrineORM;

use Doctrine\ORM\EntityManager;
use Domain\Persistence\Repository\UserRepositoryInterface;
use Infrastructure\Persistence\DoctrineORM\Repository\UserRepository;

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
                EntityManager::class => EntityManagerFactory::class,
                TODO UserRepositoryInterface::class => UserRepository::class,
            ],
        ];
    }
}
