<?php

declare(strict_types=1);

namespace app\components\Offer\Domain\Contract;

use app\components\Offer\Domain\Aggregate\Offer;

interface OfferMutatorInterface
{
    public function setNext(OfferMutatorInterface $next): OfferMutatorInterface;
    public function mutateOffer(Offer $offer): Offer;
}
