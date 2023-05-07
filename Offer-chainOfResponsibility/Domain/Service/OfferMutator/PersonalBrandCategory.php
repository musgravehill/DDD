<?php

declare(strict_types=1);

namespace app\components\Offer\Domain\Service\OfferMutator;

use app\components\Offer\Domain\Aggregate\Offer;
use app\components\Offer\Domain\Contract\OfferMutatorInterface;
use app\components\Offer\Domain\Contract\SalePersonalBrandCategoryRepositoryInterface;
use app\components\Offer\Domain\VO\Money;
use app\components\Offer\Domain\VO\MoneyСurrency;
use app\components\Offer\Domain\VO\OfferItem;
use app\components\Sale\Domain\VO\SaleTypeId;

class PersonalBrandCategory extends OfferMutator implements OfferMutatorInterface
{
    private SaleTypeId $saleTypeId;

    public function __construct(
        private SalePersonalBrandCategoryRepositoryInterface $salePersonalBrandCategoryRepository
    ) {
        $this->saleTypeId = SaleTypeId::PersonalBrandCategory;
    }

    public function mutateOffer(Offer $offer): Offer
    {        
        $offerItems =  $offer->getItems();
        foreach ($offerItems as $offerItem) {
            /** @var OfferItem $offerItem */

            $percent = $this->salePersonalBrandCategoryRepository->getPercent(
                userId: $offer->getUserId(),
                brandId: $offerItem->getBrandId(),
                brandCategoryId: $offerItem->getBrandCategoryId()
            );

            $fc = intval((100.0 - $percent) * ($offerItem->getPriceFinal()->getFractionalCount()) / 100);
            $price = new Money($fc, MoneyСurrency::RUB);

            $offerItemModified = $offerItem->setPriceFinal(
                price: $price,
                saleTypeId: $this->saleTypeId
            );
            $offer->setItem($offerItemModified);
        }

        return parent::mutateOffer($offer);
    }
}
