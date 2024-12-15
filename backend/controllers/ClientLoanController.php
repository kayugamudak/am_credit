<?php

namespace backend\controllers;

use backend\handlers\LoanCheckHandler;
use backend\handlers\LoanDecisionHandler;
use backend\models\LoanDecisionForm;
use common\searchModels\ClientSearch;
use common\services\LoanService;
use yii\base\InvalidArgumentException;
use Yii;
use common\models\Client;
use common\models\LoanProduct;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\LoanCheckForm;
use common\repositories\ClientRepository;
use common\repositories\LoanProductRepository;
use common\searchModels\ClientLoanSearch;

class ClientLoanController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionViewLoans($clientId)
    {
        $client = ClientRepository::findById($clientId);
        $loanProducts = LoanProductRepository::find();
        $clientLoans = (new ClientLoanSearch)->search(['client_id'=>$clientId]);

        $loanCheckForm = new LoanCheckForm();
        $loanCheckForm->clientId = $clientId;

        return $this->render('view-loans', [
            'loanCheckForm' => $loanCheckForm,
            'client' => $client,
            'loanProducts' => $loanProducts,
            'clientLoans' => $clientLoans,
        ]);
    }


    public function actionCheckLoan()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $loanCheckForm = new LoanCheckForm();
        if (!$loanCheckForm->load(Yii::$app->request->post(), '') || !$loanCheckForm->validate()) {
            throw new InvalidArgumentException(json_encode($loanCheckForm->getErrors()));
        }

        $loan = (new LoanCheckHandler())->handle($loanCheckForm);

        return [
            'loan' => $loan?->toArray(),
            'success' => true,
        ];

    }


    public function actionLoanDecision()
    {
        $loanDecisionForm = new LoanDecisionForm();
        if (!$loanDecisionForm->load(\Yii::$app->request->post()) || !$loanDecisionForm->validate()) {
            throw new InvalidArgumentException(json_encode($loanDecisionForm->getErrors()));
        }

        (new LoanDecisionHandler())->handle($loanDecisionForm);
        Yii::$app->session->setFlash('success', "Loan saved");

        return $this->redirect(['view-loans', 'clientId' => $loanDecisionForm->client_id]);


    }

}