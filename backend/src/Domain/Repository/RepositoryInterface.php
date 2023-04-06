<?php

declare(strict_types=1);

namespace Domain\Repository;

use Domain\VO\IdEntityInterface;

interface RepositoryInterface
{
    public function nextId(): IdEntityInterface;
}
