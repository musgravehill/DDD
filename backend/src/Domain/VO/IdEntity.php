<?php

declare(strict_types=1);

namespace Domain\VO;

use InvalidArgumentException;

final class IdEntity extends AbstractValueObject implements InterfaceValueObject
{
    public readonly int $id;

    public function __toString(): string
    {
        return (string) $this->id;
    }

    //self-validation
    public function __construct(int $id)
    {
        if ($id < 0) {
            throw new InvalidArgumentException('id should be a positive value.');
        }
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            throw new InvalidArgumentException('id should be an INT.');
        }

        $this->id = (int) $id;
    }

    //structural equality, compare
    public function isEqualsTo(InterfaceValueObject $vo): bool
    {
        parent::isEqualsTo($vo);
        if ($this->id !== $vo->id) {
            return false;
        }
        return true;
    }

    //immutable

}
