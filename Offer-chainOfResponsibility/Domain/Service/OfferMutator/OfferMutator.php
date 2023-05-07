<?php

declare(strict_types=1);

namespace app\components\Offer\Domain\Service\OfferMutator;

use app\components\Offer\Domain\Aggregate\Offer;
use app\components\Offer\Domain\Contract\OfferMutatorInterface;

abstract class OfferMutator implements OfferMutatorInterface
{
    private ?OfferMutatorInterface $next = null;

    public function setNext(OfferMutatorInterface $next): OfferMutatorInterface
    {
        $this->next = $next;
        return $next;
    }

    public function mutateOffer(Offer $offer): Offer
    {
        if (!is_null($this->next)) {
            return $this->next->mutateOffer($offer);
        }

        return $offer;
    }
}
