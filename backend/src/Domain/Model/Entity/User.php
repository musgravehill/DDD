<?php

declare(strict_types=1);

namespace Domain\Model\Entity;

use Domain\Model\VO\Email;
use Domain\Model\VO\Money;
use Domain\Model\VO\IdInterface;
use Domain\Model\Enum\UserGender;

class User
{
    private IdInterface $id;
    private UserGender $gender = UserGender::Luntik;
    private Email $authEmail;
    private string $authPhone;
    private ?string $passHash = null;
    private string $aboutMe = '';
    private Money $amount;

    public static function create(): self
    {
        return new self();
    }

    public static function createOnRegistration(): self
    {
        return new self();
    }

    public static function createByAdmin(): self
    {
        return new self();
    }

    private function __construct()
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
