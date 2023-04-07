<?php

declare(strict_types=1);

namespace Domain\Interactor;

use Doctrine\ORM\Query\Expr\Func;
use Psr\Container\ContainerInterface;

/*
 TODO!!!!!!!!  Domain: container->get(Domain\Persistence\Repository\UserRepositoryInterface)
*/

abstract class InteractorAbstract
{
    public function __construct(
        protected readonly ContainerInterface $container
    ) {
    }
}
