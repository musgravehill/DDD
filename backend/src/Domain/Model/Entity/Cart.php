<?php

declare(strict_types=1);

namespace Domain\Model\Entity;

class Cart
{
    private ?int $id = null;
    private User|null $user = null;
}
