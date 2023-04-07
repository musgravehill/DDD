<?php

declare(strict_types=1);

namespace Domain\Model\Enum;

enum UserGender: int
{
    case Male = 1;
    case Female = 2;
    case Luntik = 0;
}
