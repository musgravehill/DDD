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
use Doctrine\ORM\Mapping\OneToOne;

enum UserGender: string
{
    case Male = "M";
    case Female = "F";
    case Luntik = "L";
}

#[ORM\Entity]
#[ORM\Table(name: 'user')]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    public function getId()
    {
        return $this->id;
    }

    #[ORM\Column(type: 'string', enumType: UserGender::class)]
    private UserGender $gender = UserGender::Luntik;

    public function getGender(): UserGender
    {
        return $this->gender;
    }

    #[ORM\Column(type: 'string', unique: true,)]
    private string $email;

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    #[ORM\Column(type: 'text', name: 'about_me', length: 65000)]
    private string $aboutMe = '';

    /** ManyToMany:bi Many users have many interests */
    /** Owner side */
    /** @var Collection<int, Interest> */
    #[ManyToMany(targetEntity: Interest::class, inversedBy: 'users')]  //  inversedBy: Interest->users
    #[JoinTable(name: 'users_interests')]
    private Collection $interests;

    public function addInterest(Interest $interest): void
    {
        $interest->addUser($this); // synchronously updating Inverse side
        $this->interests[] = $interest; // Owner side  
    }

    /** OneToMany:bi One user has many goals */
    /** Inverse side */
    /** @var Collection<int, Goal> */
    #[OneToMany(targetEntity: Goal::class, mappedBy: 'user', fetch: 'EXTRA_LAZY')] // mappedBy: Goal->user
    private Collection $goals;

    public function addGoal(Goal $goal): void
    {
        $this->goals[] = $goal; // Inverse side
    }

    /** ManyToOne:uni Many users have one city */
    /** Owner side */
    #[ManyToOne(targetEntity: City::class, fetch: 'EXTRA_LAZY')]
    #[JoinColumn(name: 'city_id', referencedColumnName: 'id')]
    private City|null $city = null;

    public function setCity(City $city): void
    {
        // No Inverse side, because UNI
        $this->city = $city; // Owner side  
    }

    /** ManyToMany:self-referencing:bi Many users have many users=friends */
    /** Inverse side */
    /** @var Collection<int, User> */
    #[ManyToMany(targetEntity: User::class, mappedBy: 'myFriends', fetch: 'EXTRA_LAZY')]
    private Collection $friendsWithMe;

    /** ManyToMany:self-referencing:bi Many users have many users=friends */
    /** Owner side */
    /** @var Collection<int, User> */
    #[JoinTable(name: 'users_friends')]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    #[InverseJoinColumn(name: 'friend_user_id', referencedColumnName: 'id')]
    #[ManyToMany(targetEntity: User::class, inversedBy: 'friendsWithMe', fetch: 'EXTRA_LAZY')]
    private Collection $myFriends;

    public function removeFriend(User $user): void
    {
        $this->myFriends->removeElement($user);
    }

    public function addFriend(User $user): void
    {
        $this->myFriends[] = $user; // I can't control friendsWithMe 
    }

    public function myFriends()
    {
        return $this->myFriends; // I can't control friendsWithMe 
    }

    public function friendsWithMe()
    {
        return $this->friendsWithMe;
    }



    public function __construct()
    {
        $this->interests = new ArrayCollection();
        $this->goals = new ArrayCollection();
        $this->friendsWithMe = new ArrayCollection();
        $this->myFriends = new ArrayCollection();
    }
}
