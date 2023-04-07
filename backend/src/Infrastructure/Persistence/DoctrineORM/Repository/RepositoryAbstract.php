<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\DoctrineORM\Repository;

use Domain\Model\VO\IdEntityInterface;
use Domain\Persistence\Repository\RepositoryInterface;

use Ramsey\Uuid\Uuid;

abstract class RepositoryAbstract implements RepositoryInterface
{
    public function nextId(): IdEntityInterface
    {
        //Who is responsible for generating? Repository! 
        $uuid = Uuid::uuid7();
        return new IdEntityUuid7($uuid->toString());
    }
}
