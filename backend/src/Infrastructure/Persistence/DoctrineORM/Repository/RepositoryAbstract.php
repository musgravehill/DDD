<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\DoctrineORM\Repository;

use Domain\Model\VO\IdEntityInterface;
use Domain\Persistence\Repository\RepositoryInterface;
use Domain\Model\VO\IdEntityUUID;

abstract class RepositoryAbstract implements RepositoryInterface
{
    public function nextId(): IdEntityInterface
    {
        return new IdEntityUUID('hhh');
    }
}
