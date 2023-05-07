<?php

declare(strict_types=1);

namespace app\components\Offer\Domain\Contract;

use app\components\Offer\Domain\VO\OfferItem;

interface SalePersonalBrandCategoryRepositoryInterface
{
    public function getPercent(?int $userId, int $brandId, int $brandCategoryId): float;   
}
