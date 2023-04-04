<?php

declare(strict_types=1);

namespace Domain\VO;

use InvalidArgumentException;

abstract class AbstractValueObject
{
    //structural equality, compare
    public function isEqualsTo(InterfaceValueObject $vo): bool
    {
        if (get_class($this) !== get_class($vo)) {
            throw new InvalidArgumentException('Objects of different classes.');
        }
        $reflection = new \ReflectionClass(self::class);
        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();
            if ($this->$name !== $vo->$name) {
                return false;
            }
        }
        return true;
    }
}
