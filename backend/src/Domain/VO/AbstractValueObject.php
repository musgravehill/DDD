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
        //It can NOT compare 2 object with plain Reflections::properties because some VO has objects\Enum as property
        // $foo->name === $bar->name
        // $foo->colorEnum === $bar->colorEnum no way! 
        return true;
    }
}