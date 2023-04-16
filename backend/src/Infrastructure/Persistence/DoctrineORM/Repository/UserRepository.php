<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\DoctrineORM\Repository;

use Domain\Repository\UserRepositoryInterface;
use Domain\Model\VO\IdInterface;
use Domain\Model\Entity\User;

/*
 TODO!!!!!!!!  Domain: container->get(Domain\Persistence\Repository\UserRepositoryInterface)
 Infrastructure\Persistence\DoctrineORM\Repository 
*/

class UserRepository extends RepositoryAbstract implements UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User|null
     */
    public function getById(IdInterface $id): ?User
    {
        //$responseDTO = $this->categoryDataService->getById($id);
        //return $responseDTO ? $this->categoryDomainMapper->map($responseDTO) : null;
        return User::create(); //TODO
    }
}
