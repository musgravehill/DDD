<?php

declare(strict_types=1);

namespace Domain\Model\VO;

/*
    1. RepositoryFoo->nextId()  
        Domain: RepositoryInterface->nextId()   
        Infrastructure: RepositoryAbstract implements Domain:RepositoryInterface
        Infrastructure: RepositoryFoo extends Infrastructure: RepositoryAbstract
        Infrastructure: RepositoryBar extends Infrastructure: RepositoryAbstract, override nextId() to custom

    2. Domain: container->get(IdEntityInterface) -> factory -> nextId
       Too generalized? If INT auto-increment generation is required, you will have to pull the persistence/repository?
*/
/*
    =Domain=
        Uses the concept of ID (IdInterface)
        The specific implementation and what is inside the ID does not matter.

    =Infrastructure:Repository=
    Decides what the ID class will be and what it contains inside.
*/

interface IdEntityInterface
{
    public function isEqualsTo(self $vo): bool;
    public function toString(): string;
}
