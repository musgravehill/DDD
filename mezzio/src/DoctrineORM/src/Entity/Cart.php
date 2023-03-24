<?php

declare(strict_types=1);

namespace DoctrineORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

#[ORM\Entity]
#[ORM\Table(name: 'cart')]
class Cart
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;    

    /** OneToOne:uni One cart has one user */
    /** Owner side */
    #[OneToOne(targetEntity: User::class)] // no InversedBy, because UNIdirectional 
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id')] // cart.user_id -> user.id
    private User|null $user = null;

}
