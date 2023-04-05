<?php

declare(strict_types=1);

namespace Domain\Entity;

enum UserGender: string
{
    case Male = "M";
    case Female = "F";
    case Luntik = "L";
}
