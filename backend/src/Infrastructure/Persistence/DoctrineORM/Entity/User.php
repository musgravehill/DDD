<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\DoctrineORM\Entity;

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

use Domain\Model\Enum\UserGender;  //???? it is ok dependency

#[ORM\Entity]
#[ORM\Table(name: 'user')]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true, length: 36, options: ['fixed' => true])]
    #[ORM\GeneratedValue(strategy: "NONE")]
    private $id;

    #[ORM\Column(type: 'string', enumType: UserGender::class)]
    private UserGender $gender = UserGender::Luntik;

    #[ORM\Column(type: 'string', name: 'auth_email', unique: true, length: 64)]
    private string $authEmail;

    #[ORM\Column(type: 'string', name: 'auth_phone', unique: true, length: 20)]
    private string $authPhone;

    #[ORM\Column(type: 'string', name: 'pass_hash', length: 128)]
    private ?string $passHash = null;

    #[ORM\Column(type: 'text', name: 'about_me', length: 65000)]
    private string $aboutMe = '';

    #[ORM\Column(type: 'bigint', name: 'amount')]
    private int $amount;

    public function __construct($id)
    {
        // MAY BE __construct(SomeInterface $id)???? 
        // WHERE CHECK ID? 
        ///////////////////////////////////////
        $this->id = $id; //////////////////////
        ///////////////////////////////////////       
    }

    /** Setters\Getters */
    public function setAuthEmail(string $email): void
    {
        $this->authEmail = $email;
    }
    public function setPassHash($passHash): void
    {
        $this->passHash = $passHash;
    }
    public function setAuthPhone($authPhone): void
    {
        $this->authPhone = $authPhone;
    }
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }


    //////
    public function getGender(): UserGender
    {
        return $this->gender;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAuthEmail(): string
    {
        return $this->authEmail;
    }
    public function getAmount(): int
    {
        return $this->amount;
    }
}
