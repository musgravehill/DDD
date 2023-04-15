<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\DoctrineORM\Repository;

use Domain\Model\VO\IdInterface;
use Domain\Persistence\Repository\RepositoryInterface;
use Infrastructure\Persistence\Identifier\IdUUIDv7;

abstract class RepositoryAbstract implements RepositoryInterface
{
    public function nextId(): IdInterface
    {
        return IdUUIDv7::fromNull();
    }
}
