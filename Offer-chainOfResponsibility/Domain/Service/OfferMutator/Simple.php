<?php

declare(strict_types=1);

namespace app\components\Offer\Domain\Service\OfferMutator;

use app\components\Offer\Domain\Aggregate\Offer;
use app\components\Offer\Domain\Contract\OfferMutatorInterface;
use app\components\Offer\Domain\VO\Money;
use app\components\Offer\Domain\VO\MoneyСurrency;
use app\components\Offer\Domain\VO\OfferItem;
use app\components\Sale\Domain\VO\SaleTypeId;

class Simple extends OfferMutator implements OfferMutatorInterface
{
    public function mutateOffer(Offer $offer): Offer
    {
        //no modification         
        return parent::mutateOffer($offer);
    }
}
