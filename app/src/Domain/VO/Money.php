<?php

declare(strict_types=1);

namespace Domain\VO;

use Doctrine\ORM\Mapping\Embeddable; //? Domain depends on /vendor!  Is it OK?
use InvalidArgumentException;

// ISO-4217
enum MoneyСurrency: int
{
    case RUB = 643;
    case USD = 840;
}

#[Embeddable]
final class Money implements VOInterface
{
    private int $fractionalCount; //cent, kopek, céntimo, dinar    
    private MoneyСurrency $currency;

    public function __construct(int $fractionalCount, MoneyСurrency $currency)
    {

        if ($fractionalCount < 0) {
            throw new \InvalidArgumentException('FractionalCount should be a positive value.');
        }

        if (!filter_var($fractionalCount, FILTER_VALIDATE_INT)) {
            throw new \InvalidArgumentException('FractionalCount should be an INT.');
        }

        $this->fractionalCount = $fractionalCount;
        $this->currency = $currency;
    }

    public function isEqualsTo(VOInterface $vo): bool
    {
        $condition0 = (int) $this->fractionalCount === (int) $vo->fractionalCount;
        $condition1 = $this->currency === $vo->currency;

        return $condition0 && $condition1;
    }

    public function __toString(): string
    {
        return $this->fractionalCount.'_'.$this->currency->name;
    }
}
