<?php

declare(strict_types=1);

namespace DoctrineORM\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;

#[ORM\Entity]
#[ORM\Table(name: 'interest')]
class Interest
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'string', name: 'ttl', length: 128)]
    private string $ttl;

    /** ManyToMany:bi Many interests have many users */
    /** Inverse side */
    /** @var Collection<int, Users> */
    #[ManyToMany(targetEntity: User::class, mappedBy: 'interests')]  //  mappedBy: User->interests     
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function addUser(User $user): void
    {
        $this->users[] = $user;
    }
}
