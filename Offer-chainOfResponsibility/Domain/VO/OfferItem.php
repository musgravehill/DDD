<?php

declare(strict_types=1);

namespace app\components\Offer\Domain\VO;

use app\components\Sale\Domain\VO\SaleTypeId;
use InvalidArgumentException;

final class OfferItem extends ValueObjectAbstract implements ValueObjectInterface
{
    /** @property SaleTypeId[] $appliedSaleTypeId */

    //self-validation
    public function __construct(
        private readonly int $productId,
        private readonly int $quantity,
        private readonly Money $priceInitial,
        private readonly Money $priceFinal,
        private readonly int $brandId,
        private readonly int $brandCategoryId,
        private readonly array $appliedSaleTypeIds
    ) {
        if ($productId <= 0 || $quantity < 0 || $quantity > 9999999 || $brandId < 0 || $brandCategoryId < 0) {
            throw new InvalidArgumentException('Arguments are not valid (out of range).');
        }
        if ($this->priceInitial->getFractionalCount() <= 0 || $this->priceFinal->getFractionalCount() <= 0) {
            throw new InvalidArgumentException('Price <= 0.');
        }
    }

    public function getStructuralEqualityIdentifier(): string
    {
        return sha1(serialize([$this->productId,])); //you can add params (color white-red, size S-M-L) to array
    }

    //structural equality, compare   
    /** @param OfferItem $vo */
    public function isEqualsTo(ValueObjectInterface $vo): bool
    {
        parent::isEqualsTo($vo);
        if ($this->getStructuralEqualityIdentifier() !== $vo->getStructuralEqualityIdentifier()) {
            return false;
        }
        return true;
    }

    public function toString(): string
    {
        return (string) $this->getStructuralEqualityIdentifier();
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPriceInitial(): Money
    {
        return $this->priceInitial;
    }

    public function getPriceFinal(): Money
    {
        return $this->priceFinal;
    }

    public function getBrandId(): int
    {
        return $this->brandId;
    }

    public function getBrandCategoryId(): int
    {
        return $this->brandCategoryId;
    }

    /** @return SaleTypeId[] */
    public function getAppliedSaleTypeIds(): array
    {
        return $this->appliedSaleTypeIds;
    }

    public function setPriceFinal(Money $price, SaleTypeId $saleTypeId): self
    {
        $appliedSaleTypeIds = array_merge($this->getAppliedSaleTypeIds(), [$saleTypeId]);
        return new OfferItem(
            productId: $this->getProductId(),
            quantity: $this->getQuantity(),
            priceInitial: $this->getPriceInitial(),
            priceFinal: $price,
            brandId: $this->getBrandId(),
            brandCategoryId: $this->getBrandCategoryId(),
            appliedSaleTypeIds: $appliedSaleTypeIds
        );
    }
}
