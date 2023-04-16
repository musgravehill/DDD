<?php

declare(strict_types=1);

namespace Domain\Repository;

use Domain\Model\VO\IdInterface;
use Domain\Model\Entity\User;

interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $id
     * @return User|null
     */
    public function getById(IdInterface $id): ?User;
}
