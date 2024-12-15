<?php

namespace common\repositories;

use common\models\LoanProduct;
use common\repositories\AbstractRepository;

class LoanProductRepository extends AbstractRepository {
    protected static string $entityClass = LoanProduct::class;
}