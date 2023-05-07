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

class TotalCostLevelUp extends OfferMutator implements OfferMutatorInterface
{
    private SaleTypeId $saleTypeId;
    private int $totalCostFractionalCountOver = 10000; // over 1000$
    private int $saleFractionalCount = 50000; // -500$

    public function __construct()
    {
        $this->saleTypeId = SaleTypeId::TotalCostLevelUp;
    }

    public function mutateOffer(Offer $offer): Offer
    {
        $totalCost = $offer->getTotalCost();
        $saleFractionalCountRest = $this->saleFractionalCount;
        if ($totalCost->getFractionalCount() >= $this->totalCostFractionalCountOver) {
            $offerItems =  $offer->getItems();
            foreach ($offerItems as $offerItem) {
                /** @var OfferItem $offerItem */
                if ($saleFractionalCountRest <= 0) {
                    continue;
                }
                $deltaForOneMax = intval(floor($saleFractionalCountRest / $offerItem->getQuantity()));
                $itemPrice = $offerItem->getPriceFinal()->getFractionalCount();
                $deltaForOne = ($deltaForOneMax >= $itemPrice) ? ($itemPrice - 1) : $deltaForOneMax;
                $priceFinal = new Money(($itemPrice - $deltaForOne), MoneyСurrency::RUB);
                $saleFractionalCountRest -= $deltaForOne * $offerItem->getQuantity();

                $offerItemModified = $offerItem->setPriceFinal(
                    price: $priceFinal,
                    saleTypeId: $this->saleTypeId
                );
                $offer->setItem($offerItemModified);
            }
        }

        return parent::mutateOffer($offer);
    }
}
