<?php

declare(strict_types=1);

namespace Domain\Model\VO;

/*
    =Domain=
        Uses the concept of ID (IdInterface)
        The specific implementation and what is inside the ID does not matter.

    =Infrastructure:Repository=
    Decides what the ID class will be and what it contains inside.
*/

interface IdInterface
{
    public function isEqualsTo(self $vo): bool;
    public function toString(): string;
}
