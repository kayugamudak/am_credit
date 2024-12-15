<?php

namespace backend\handlers;

use backend\models\LoanCheckForm;
use common\models\Loan;
use common\repositories\ClientRepository;
use common\repositories\LoanProductRepository;
use common\services\LoanService;
use yii\base\InvalidArgumentException;

class LoanCheckHandler
{
    public function handle(LoanCheckForm $form): ?Loan
    {
        $client = ClientRepository::findById($form->clientId);
        $loanProduct = LoanProductRepository::findById($form->loanProductId);

        if (!$loanProduct || !$client) {
            throw new InvalidArgumentException('The requested entity does not exist');
        }

        $loanServiceConfig = \Yii::$app->params['loanService'] ?? [];

        $loanService = new LoanService(
            $loanServiceConfig['minFicoCreditScore'] ?? 0,
            $loanServiceConfig['minIncome'] ?? 0,
            $loanServiceConfig['minAge'] ?? 0,
            $loanServiceConfig['maxAge'] ?? 0,
            $loanServiceConfig['allowedStates'] ?? []
        );
        return $loanService->getLoan($client, $loanProduct);
    }

}
