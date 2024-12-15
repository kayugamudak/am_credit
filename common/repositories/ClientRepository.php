<?php

namespace common\repositories;

use common\models\Client;
use common\repositories\AbstractRepository;

class ClientRepository extends AbstractRepository {
    protected static string $entityClass = Client::class;
}