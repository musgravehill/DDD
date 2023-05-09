<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Identifier;

use Domain\Model\VO\IdInterface;
use Domain\Model\VO\ValueObjectAbstract;
use Domain\Model\VO\ValueObjectInterface;
use InvalidArgumentException;

use Ramsey\Uuid\Uuid;

final class IdUUIDv7 extends ValueObjectAbstract implements IdInterface, ValueObjectInterface
{
    //immutable
    private readonly string $id;

    public function toString(): string
    {
        return (string) $this->id;
    }

    //self-validation
    private function __construct(string $string)
    {
        if (!Uuid::isValid($string)) {
            throw new InvalidArgumentException('Id should be a Ramsey\Uuid\Uuid.');
        }
        $this->id = $string;
    }

    //structural equality, compare
    public function isEqualsTo(ValueObjectInterface $vo): bool
    {
        parent::isEqualsTo($vo);
        if ($this->id !== $vo->id) {
            return false;
        }
        return true;
    }

    public static function fromString(string $string): self
    {
        return new self($string);
    }

    public static function fromNull(): self
    {
        $uuidObject = Uuid::uuid7();
        return new self($uuidObject->toString());
    }
}
