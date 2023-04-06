<?php

declare(strict_types=1);

namespace Domain\VO;

use InvalidArgumentException;

final class IdEntityString  implements IdEntityInterface
{
    public readonly string $id;

    public function __toString(): string
    {
        return (string) $this->id;
    }

    //self-validation
    public function __construct(string $id)
    {
        if (strlen($id) <= 0) {
            throw new InvalidArgumentException('Id should be a not empty string.');
        }

        $this->id = (string) $id;
    }

    //structural equality, compare
    public function isEqualsTo(IdEntityInterface $vo): bool
    {
        if ($this->id !== $vo->id) {
            return false;
        }
        return true;
    }

    //immutable

}
