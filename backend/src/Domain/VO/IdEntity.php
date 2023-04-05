<?php

declare(strict_types=1);

namespace Domain\VO;

use InvalidArgumentException;

final class IdEntity extends AbstractValueObject implements InterfaceValueObject
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
            throw new InvalidArgumentException('id should be a not empty string.');
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
