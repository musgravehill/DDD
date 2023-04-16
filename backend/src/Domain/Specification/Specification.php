<?php

declare(strict_types=1);

namespace Domain\Specification;

interface Specification
{
    public function isSatisfiedBy(Item $item): bool;
}
