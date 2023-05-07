<?php

declare(strict_types=1);

namespace app\components\Offer\Domain\VO;

use InvalidArgumentException;

final class Money extends ValueObjectAbstract implements ValueObjectInterface
{
    private readonly int $fractionalCount; //cent, kopek, céntimo, dinar      
    private readonly MoneyСurrency $currency;

    public function toString(): string
    {
        return (string) $this->fractionalCount . ' ' . $this->currency->name;
    }

    //self-validation
    public function __construct(int $fractionalCount, MoneyСurrency $currency)
    {
        if ($fractionalCount < 0) {
            throw new InvalidArgumentException('FractionalCount should be a positive value.');
        }
        if (filter_var($fractionalCount, FILTER_VALIDATE_INT) === false) {
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

    public function getFractionalCount(): int
    {
        return $this->fractionalCount;
    }
}
