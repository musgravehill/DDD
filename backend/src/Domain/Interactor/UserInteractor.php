<?php

declare(strict_types=1);

namespace Domain\Interactor;

use Exception;
use Psr\Container\ContainerInterface;

/*
 TODO!!!!!!!!  Domain: container->get(Domain\Persistence\Repository\UserRepositoryInterface)
*/

class UserInteractor extends  InteractorAbstract
{

    public function in()
    {
        
        //$this->container->get(\Doctrine\ORM\EntityManager::class);
        throw new Exception('IN OK');
    }
}
