<?php

declare(strict_types=1);

namespace app\components\Offer\Domain\Contract;

use app\components\Offer\Domain\VO\OfferItem;

interface ProductRepositoryInterface
{
    public function getOfferItem(int $productId, int $quantity): ?OfferItem;
}
