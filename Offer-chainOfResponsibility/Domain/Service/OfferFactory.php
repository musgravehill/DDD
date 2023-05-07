<?php

declare(strict_types=1);

namespace app\components\Offer\Domain\Service;

use app\components\Offer\Domain\Aggregate\Offer;
use app\components\Offer\Domain\Contract\ProductRepositoryInterface;
use app\components\Offer\Infrastructure\ProductRepository;
use app\components\Offer\Domain\Service\OfferMutator as OfferMutator;

use app\components\Offer\Infrastructure\SalePersonalBrandCategoryRepository;

class OfferFactory
{
    /** @property OfferItem[] $items */
    private array $items = [];
    private ProductRepositoryInterface $productRepository;

    public function __construct(
        private ?int $userId
    ) {
        $this->productRepository = new ProductRepository(); //BAD way
    }

    public function addItem(int $productId, int $quantity): void
    {
        $offerItem = $this->productRepository->getOfferItem($productId, $quantity);
        if (is_null($offerItem)) {
            return;
        }
        $this->items[] = $offerItem;
    }

    public function getOffer(): Offer
    {
        $offer = new Offer(userId: $this->userId, items: $this->items);

        $simple = new OfferMutator\Simple();
        $personalBrandCategory = new OfferMutator\PersonalBrandCategory(new SalePersonalBrandCategoryRepository()); //BAD way
        $totalCostLevelUp = new OfferMutator\TotalCostLevelUp();
        
        //$simple->setNext($personalBrandCategory)->setNext($totalCostLevelUp);
        $simple->setNext($personalBrandCategory);

        return $simple->mutateOffer($offer);
    }
}
