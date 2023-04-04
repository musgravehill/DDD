<?php

declare(strict_types=1);

namespace Domain\VO;

//use Doctrine\ORM\Mapping\Embeddable;  #[Embeddable]
//use Psalm/Immutable;                  #[Immutable]

interface InterfaceValueObject
{
    public function isEqualsTo(InterfaceValueObject $vo): bool;
    public function __toString(): string;
}

// php-8.1 public readonly int $param;
// php-8.2 readonly className 
