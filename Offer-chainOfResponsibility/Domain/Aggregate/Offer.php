<?php

declare(strict_types=1);

namespace app\components\Offer\Domain\Aggregate;

use app\components\Offer\Domain\VO\Money;
use app\components\Offer\Domain\VO\MoneyСurrency;
use app\components\Offer\Domain\VO\OfferItem;

class Offer
{
    /** @property int $userId */
    /** @property OfferItem[] $items */

    public function __construct(
        private ?int $userId,
        private array $items
    ) {
    }

    /** @return OfferItem[] $items */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setItem(OfferItem $itemModified): void
    {
        foreach ($this->items as $i => $item) {
            /** @var OfferItem $item */
            if ($item->isEqualsTo($itemModified)) {
                $this->items[$i] = $itemModified;
                return;
            }
        }
    }

    public function getTotalCost(): Money
    {
        if (empty($this->items)) {
            return new Money(fractionalCount: 0, currency: MoneyСurrency::RUB);
        }

        $fractionalCount = 0;
        foreach ($this->items as $item) {
            /** @var OfferItem $item */
            $fractionalCount += $item->getQuantity() * $item->getPriceFinal()->getFractionalCount();
        }

        return new Money(fractionalCount: $fractionalCount, currency: MoneyСurrency::RUB);
    }

    public function getTotalQuantity(): int
    {
        /** @var OfferItem $item */
        return array_reduce(
            $this->items,
            function ($accumulator, $item) {
                $accumulator += $item->getQuantity();
                return $accumulator;
            }
        ) ?? 0;
    }
}
