<?php

declare(strict_types=1);

namespace Domain\VO;

//use Doctrine\ORM\Mapping\Embeddable;  #[Embeddable]

interface VOInterface
{
    public function isEqualsTo(VOInterface $vo): bool;
    public function __toString(): string;
}
