<?php

namespace common\tests\unit\models;

use common\repositories\ClientRepository;
use common\repositories\LoanProductRepository;
use common\services\LoanService;
use Yii;
use common\fixtures\ClientFixture;
use common\fixtures\LoanProductFixture;


class LoanComplianceTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;


    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'client' => [
                'class' => ClientFixture::class,
                'dataFile' => codecept_data_dir() . 'client.php'
            ],
            'loanProduct' => [
                'class' => LoanProductFixture::class,
                'dataFile' => codecept_data_dir() . 'loan_product.php'
            ],
        ];
    }


    protected function getLoanService(): LoanService
    {
        $loanServiceConfig = \Yii::$app->params['loanService'] ?? [];

        return new LoanService(
            $loanServiceConfig['minFicoCreditScore'] ?? 0,
            $loanServiceConfig['minIncome'] ?? 0,
            $loanServiceConfig['minAge'] ?? 0,
            $loanServiceConfig['maxAge'] ?? 0,
            $loanServiceConfig['allowedStates'] ?? []
        );
    }

    public function testRejectedByIncome()
    {
        $client = ClientRepository::findById(10);
        $loanProduct = LoanProductRepository::findById(1);
        $loanService = $this->getLoanService();
        $loan = $loanService->getLoan($client, $loanProduct);

        verify($loan->isPreApproved())->false();
    }

    public function testRejectedByCreditScore()
    {
        $client = ClientRepository::findById(11);
        $loanProduct = LoanProductRepository::findById(1);
        $loanService = $this->getLoanService();
        $loan = $loanService->getLoan($client, $loanProduct);

        verify($loan->isPreApproved())->false();
    }

    public function testRejectedByState()
    {
        $client = ClientRepository::findById(12);
        $loanProduct = LoanProductRepository::findById(1);
        $loanService = $this->getLoanService();
        $loan = $loanService->getLoan($client, $loanProduct);

        verify($loan->isPreApproved())->false();
    }

    public function testRejectedByAge()
    {
        $client = ClientRepository::findById(13);
        $loanProduct = LoanProductRepository::findById(1);
        $loanService = $this->getLoanService();
        $loan = $loanService->getLoan($client, $loanProduct);

        verify($loan->isPreApproved())->false();
    }

    public function testAprovedWithIncreasedRate()
    {
        $client = ClientRepository::findById(14);
        $loanProduct = LoanProductRepository::findById(1);
        $loanService = $this->getLoanService();
        $loan = $loanService->getLoan($client, $loanProduct);

        verify($loan->isPreApproved())->true();
        verify($loan->getPercentageRate())->equals($loanProduct->getPercentageRate() + 11.49);
    }

    public function testBasicallyAproved()
    {
        $client = ClientRepository::findById(15);
        $loanProduct = LoanProductRepository::findById(1);
        $loanService = $this->getLoanService();
        $loan = $loanService->getLoan($client, $loanProduct);

        verify($loan->isPreApproved())->true();
        verify($loan->getPercentageRate())->equals($loanProduct->getPercentageRate());
    }
}
