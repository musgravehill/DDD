<?php

declare(strict_types=1);

namespace Domain\VO;

use Doctrine\ORM\Mapping\Embeddable; //? Domain depends on /vendor!  Is it OK?
use InvalidArgumentException;

#[Embeddable]
final class Email implements VOInterface
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
        return (string)$this->email === (string)$vo->email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
