<?php

declare(strict_types=1);

namespace Domain\Entity;

use Domain\VO\Email;
use Domain\VO\Money;
use Domain\VO\IdEntityInterface;

class User
{
    private ?IdEntityInterface $id = null;
    private UserGender $gender = UserGender::Luntik;
    private Email $authEmail;
    private string $authPhone;
    private ?string $passHash = null;
    private string $aboutMe = '';
    private Money $amount;

    public function __construct()
    {
    }

    public function setAuthEmail(Email $email): void
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
    public function setAmount(Money $amount): void
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
    public function getAuthEmail(): Email
    {
        return $this->authEmail;
    }
    public function getAmount(): Money
    {
        return $this->amount;
    }
}
