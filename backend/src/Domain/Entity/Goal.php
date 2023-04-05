<?php

declare(strict_types=1);

namespace Domain\Entity;

class Goal
{
    private ?int $id = null;
    private string $ttl;
    private User|null $user = null;
}
