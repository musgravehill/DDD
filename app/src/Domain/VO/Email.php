<?php

declare(strict_types=1);

namespace Domain\VO;

use Doctrine\ORM\Mapping\Embeddable;
use Doctrine\ORM\Mapping as ORM;

use InvalidArgumentException;

#[Embeddable]
final class Email extends AbstractValueObject implements InterfaceValueObject
{
    #[ORM\Column(type: 'string', name: 'email', unique: true)]
    public readonly string $email;

    public function __toString(): string
    {
        return $this->email;
    }

    //self-validation
    public function __construct($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email is not valid.');
        }

        $this->email = (string) $email;
    }

    //structural equality, compare
    public function isEqualsTo(InterfaceValueObject $vo): bool
    {
        parent::isEqualsTo($vo);
        if ($this->email !== $vo->email) {
            return false;
        }
        return true;
    }

    //immutable

}
