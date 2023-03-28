<?php

declare(strict_types=1);

namespace DoctrineORM\Service;

use DoctrineORM\DTO\UserCreateByEmailPassDTO;
use DoctrineORM\Entity\User;

class Registration
{
    public function __construct(
        private \Doctrine\ORM\EntityManager $entityManager
    ) {
    }

    public function UserCreateByEmailPass(UserCreateByEmailPassDTO $dto): bool
    {
        $user = new User();
        $user->setAuthEmail($dto->authEmail);
        $user->setPassHash($dto->passHash);
        $user->setAuthPhone(uniqid());
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }
}
