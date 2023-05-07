<?php

declare(strict_types=1);

namespace app\components\Offer\Domain\VO;

// ISO-4217
enum MoneyСurrency: int
{
    case RUB = 643;
    case USD = 840;
}
