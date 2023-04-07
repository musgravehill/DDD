<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\DoctrineORM\Repository;

use Domain\Model\VO\IdEntityInterface;
use InvalidArgumentException;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class IdEntityUuid7 implements IdEntityInterface
{
    /** @var Uuid */
    private readonly UuidInterface $id;

    public function toString(): string
    {
        return (string) $this->id->toString();
    }

    //self-validation
    public function __construct(string $string)
    {
        if (!Uuid::isValid($string)) {
            throw new InvalidArgumentException('Id should be a Ramsey\Uuid\Uuid.');
        }

        $this->id = Uuid::fromString($string);
    }

    //structural equality, compare
    public function isEqualsTo(IdEntityInterface $vo): bool
    {
        if (!$this->id->equals($vo->id)) {
            return false;
        }

        return true;
    }

    //immutable

}
