<?php

declare(strict_types=1);

namespace Domain\Model\VO;

/*
    1. RepositoryFoo->nextId()  
        Domain\Repository\RepositoryInterface->nextId()   
        Infrastructure\Repository\RepositoryAbstract implements Domain\Repository\RepositoryInterface
        RepositoryFoo extends RepositoryAbstract
        RepositoryBar extends RepositoryAbstract, override nextId() to custom

    2. Domain: container->get(IdEntityInterface) -> factory -> nextId
       Too generalized? If INT auto-increment generation is required, you will have to pull the persistence/repository?

*/

interface IdEntityInterface
{
    public function isEqualsTo(self $vo): bool;
    public function __toString(): string;
}
