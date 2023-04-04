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

//#[Embeddable]
class Money extends AbstractValueObject implements InterfaceValueObject
{
    private int $fractionalCount; //cent, kopek, céntimo, dinar    
    private readonly MoneyСurrency $currency;

    public function __toString(): string
    {
        return $this->fractionalCount . '_' . $this->currency->name;
    }

    public function getFractionalCount(): int
    {
        return $this->fractionalCount;
    }

    public function getCurrency(): MoneyСurrency
    {
        return $this->currency;
    }

    //self-validation
    public function __construct(int $fractionalCount, MoneyСurrency $currency)
    {
        if ($fractionalCount < 0) {
            throw new InvalidArgumentException('FractionalCount should be a positive value.');
        }
        if (!filter_var($fractionalCount, FILTER_VALIDATE_INT)) {
            throw new InvalidArgumentException('FractionalCount should be an INT.');
        }
        $this->fractionalCount = $fractionalCount;
        $this->currency = $currency;
    }

    private function isCurrencyEqualsTo(self $vo): bool
    {
        return $this->currency === $vo->currency;
    }

    //immutable
    public function getSumWith(self $vo): self
    {
        if (!$this->isCurrencyEqualsTo($vo)) {
            throw new InvalidArgumentException('You must sum the same currencies.');
        }

        return new self(fractionalCount: ($this->fractionalCount + $vo->fractionalCount), currency: $this->currency);
    }
}
