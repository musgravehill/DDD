<?php

declare(strict_types=1);

namespace Domain\VO;

//use Doctrine\ORM\Mapping\Embeddable; //? Domain depends on /vendor!  Is it OK? 
use InvalidArgumentException;

// ISO-4217
enum MoneyСurrency: int
{
    case RUB = 643;
    case USD = 840;
}

//#[Embeddable]
final class Money extends AbstractValueObject implements InterfaceValueObject
{
    public readonly int $fractionalCount; //cent, kopek, céntimo, dinar      
    public readonly MoneyСurrency $currency;

    public function __toString(): string
    {
        return $this->fractionalCount . ' fractional of ' . $this->currency->name;
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

    //structural equality, compare
    public function isEqualsTo(InterfaceValueObject $vo): bool
    {
        parent::isEqualsTo($vo);
        if ($this->fractionalCount !== $vo->fractionalCount) {
            return false;
        }
        if ($this->currency->value !== $vo->currency->value) {
            return false;
        }
        return true;
    }

    //immutable
    public function getSumWith(self $vo): self
    {
        if (!$this->isCurrencyEqualsTo($vo)) {
            throw new InvalidArgumentException('You must sum the same currencies.');
        }

        return new self(fractionalCount: ($this->fractionalCount + $vo->fractionalCount), currency: $this->currency);
    }
    private function isCurrencyEqualsTo(self $vo): bool
    {
        return $this->currency === $vo->currency;
    }
}
