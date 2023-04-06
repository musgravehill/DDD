<?php

declare(strict_types=1);

namespace Domain\VO;

interface IdEntityInterface 
{
    public function isEqualsTo(self $vo): bool;
    public function __toString(): string;
}
