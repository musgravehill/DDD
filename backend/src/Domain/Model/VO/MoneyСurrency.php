<?php

declare(strict_types=1);

namespace Domain\Model\VO;

// ISO-4217
enum MoneyСurrency: int
{
    case RUB = 643;
    case USD = 840;
}
