<?php

declare(strict_types=1);

namespace DoctrineORM\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
#[ORM\Table(name: 'goal')]
class Goal
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'string', name: 'ttl', length: 128)]
    private string $ttl;

    /** ManyToOne:bi Many interests have one user */
    /** Owner side (has ForeignKey FK) */    
    #[ManyToOne(targetEntity: User::class, inversedBy: 'goals')] // inversedBy: User->goals
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id')] // goal.user_id   user.id 
    private User|null $user = null;
     
}
