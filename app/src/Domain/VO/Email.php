<?php

declare(strict_types=1);

namespace Domain\VO;

use Doctrine\ORM\Mapping\Embeddable; //? Domain depends on /vendor!  Is it OK?
use InvalidArgumentException;

#[Embeddable]
class Email implements VOInterface
{
    private string $email = '';

    public function __construct($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email is not valid.');
        }

        $this->email = (string) $email;
    }

    public function isEqualsTo(VOInterface $vo): bool
    {
        if (get_class($this) !== get_class($vo)) {
            throw new InvalidArgumentException('Objects of different classes.');
        }
        if ($this->email !== $vo->email) {
            return false;
        }
        return true;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
