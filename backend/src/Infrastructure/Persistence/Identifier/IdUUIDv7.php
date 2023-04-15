<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Identifier;

use Domain\Model\VO\IdInterface;
use InvalidArgumentException;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class IdUUIDv7 implements IdInterface
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
    public function isEqualsTo(IdInterface $vo): bool
    {
        if (get_class($this) !== get_class($vo)) {
            return false;
        }
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
