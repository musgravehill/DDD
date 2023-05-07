<?php

declare(strict_types=1);

namespace app\components\Offer\Infrastructure;

use app\components\Offer\Domain\Contract\SalePersonalBrandCategoryRepositoryInterface;
use LogicException;
use InvalidArgumentException;
use Yii;
use yii\db\Query;

class SalePersonalBrandCategoryRepository implements SalePersonalBrandCategoryRepositoryInterface
{
    public function getPercent(?int $userId, int $brandId, int $brandCategoryId): float
    {
        if (!$userId || !$brandId || !$brandCategoryId) {
            return 0.0;
        }

        $row = (new Query())
            ->select('sale_percent')
            ->from('{{%sale_personal_brand}}')
            ->where(['user_id' => $userId, 'brand_id' => $brandId, 'brand_category_id' => $brandCategoryId])
            ->one();

        if (!$row) {
            return 0.0;
        }
        return floatval($row['sale_percent']);
    }
}
