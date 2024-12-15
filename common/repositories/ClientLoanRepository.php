<?php

namespace common\repositories;

use common\models\ClientLoan;
use common\repositories\AbstractRepository;

class ClientLoanRepository extends AbstractRepository {
    protected static string $entityClass = ClientLoan::class;
}