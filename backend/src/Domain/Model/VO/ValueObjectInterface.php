<?php

declare(strict_types=1);

namespace Domain\Model\VO;

//use Doctrine\ORM\Mapping\Embeddable;  #[Embeddable]
//use Psalm/Immutable;                  #[Immutable]

interface ValueObjectInterface
{
    public function isEqualsTo(self $vo): bool;
    public function toString(): string;
}

// php-8.1 public readonly int $param;
// php-8.2 readonly className 
