<?php

declare(strict_types=1);

namespace Domain\Entity;

class Interest
{
    private ?int $id = null;
    private string $ttl;

    public function __construct()
    {
    }
}
