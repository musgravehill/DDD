<?php

declare(strict_types=1);

namespace DoctrineORM\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
#[ORM\Table(name: 'user')]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    private string $email;

    #[ORM\Column(type: 'text', name: 'about_me', length: 65000)]
    private string $aboutMe;

    /** ManyToMany:bi Many users have many interests */
    /** Owner side */
    /** @var Collection<int, Interest> */
    #[ManyToMany(targetEntity: Interest::class, inversedBy: 'users')]  //  inversedBy: Interest->users
    #[JoinTable(name: 'users_interests')]
    private Collection $interests;

    /** OneToMany:bi One user has many goals */
    /** Inverse side */
    /** @var Collection<int, Goal> */
    #[OneToMany(targetEntity: Goal::class, mappedBy: 'user')] // mappedBy: Goal->user
    private Collection $goals;

    /** ManyToOne:uni Many users have one city */
    /** Owner side */
    #[ManyToOne(targetEntity: City::class)]
    #[JoinColumn(name: 'city_id', referencedColumnName: 'id')]
    private City|null $city = null;

    /** ManyToMany:self-referencing Many users have many users=friends */
    /** @var Collection<int, User> */
    #[JoinTable(name: 'users_friends')]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[InverseJoinColumn(name: 'friend_user_id', referencedColumnName: 'id')]
    #[ManyToMany(targetEntity: 'User')] // , inversedBy: 'friendsWithMe'
    private Collection $myFriends;

    /** ManyToMany:self-referencing Many users have many users=friends */
    /** @var Collection<int, User> */
    /* #[ManyToMany(targetEntity: User::class, mappedBy: 'myFriends')]
    private Collection $friendsWithMe;
    */

    //bi-derectional with $friendsWithMe;

    public function __construct()
    {
        $this->interests = new ArrayCollection();
        $this->goals = new ArrayCollection();
        //$this->friendsWithMe = new ArrayCollection();
        $this->myFriends = new ArrayCollection();
    }

    public function addInterest(Interest $interest): void
    {
        $interest->addUser($this); // synchronously updating Inverse side
        $this->interests[] = $interest; // Owner side  
    }

    // TODO 
    // add rich-model functions for owner\inverse sides to control changes
}
