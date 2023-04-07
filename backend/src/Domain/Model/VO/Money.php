<?php

declare(strict_types=1);

namespace Domain\Model\VO;

use InvalidArgumentException;

final class Money extends ValueObjectAbstract implements ValueObjectInterface
{
    public readonly int $fractionalCount; //cent, kopek, céntimo, dinar      
    public readonly MoneyСurrency $currency;

    public function __toString(): string
    {
        return (string) $this->fractionalCount . ' fractional of ' . $this->currency->name;
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
    public function isEqualsTo(ValueObjectInterface $vo): bool
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
