<?php

declare(strict_types=1);

namespace app\components\Offer\Infrastructure;


use app\components\Offer\Domain\Contract\ProductRepositoryInterface;
use app\components\Offer\Domain\VO\Money;
use app\components\Offer\Domain\VO\MoneyСurrency;
use app\components\Offer\Domain\VO\OfferItem;
use LogicException;
use InvalidArgumentException;
use Yii;
use yii\db\Query;

class ProductRepository implements ProductRepositoryInterface
{
    public function getOfferItem(int $productId, int $quantity): ?OfferItem
    {
        $row = (new Query())
            ->select('price, brand_id, brand_category_id')
            ->from('{{%product}}')
            ->where(['id' => $productId])
            ->one();

        if (!$row) {
            return null;
        }

        $price = new Money(fractionalCount: intval(100 * $row['price']), currency: MoneyСurrency::RUB);
        $brandId = $row['brand_id'];
        $brandCategoryId = $row['brand_category_id'];

        return new OfferItem(
            productId: $productId,
            quantity: $quantity,
            priceInitial: $price,
            priceFinal: $price,
            brandId: $brandId,
            brandCategoryId: $brandCategoryId,
            appliedSaleTypeIds: []
        );
    }
}
