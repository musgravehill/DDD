<?php

declare(strict_types=1);

namespace Domain\Model\VO;

use InvalidArgumentException;

final class IdEntityUUID  implements IdEntityInterface
{
    public readonly ?string $id;

    public function __toString(): string
    {
        return (string) $this->id;
    }

    //self-validation
    public function __construct(?string $id)
    {
        if (!is_null($id) && strlen($id) <= 0) {
            throw new InvalidArgumentException('Id should be a not empty string or Null.');
        }

        $this->id = $id;
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
