<?php

namespace backend\handlers;

use backend\models\LoanDecisionForm;
use common\models\ClientLoan;
use common\repositories\ClientRepository;
use console\jobs\SendEmailJob;
use console\jobs\SendSmsJob;
use yii\base\InvalidArgumentException;

class LoanDecisionHandler
{
    public function handle(LoanDecisionForm $form): void
    {
        $this->createClientLoan($form);

        $this->handleNotifications($form);
    }

    protected function createClientLoan(LoanDecisionForm $form): void
    {
        $clientLoan = new ClientLoan();
        $clientLoan->name = $form->name;
        $clientLoan->client_id = $form->client_id;
        $clientLoan->loan_product_id = $form->loan_product_id;
        $clientLoan->loan_term_days = $form->loan_term_days;
        $clientLoan->amount = $form->amount;
        $clientLoan->percentage_rate = $form->percentage_rate;
        $clientLoan->approved = $form->approved;
        if(!$clientLoan->save()) {
            throw new InvalidArgumentException(json_encode($clientLoan->getErrors()));
        }
    }


    protected function handleNotifications(LoanDecisionForm $form): void
    {
        $client = ClientRepository::findById($form->client_id);

        if ($form->send_email) {
            \Yii::$app->queueEmail->push(new SendEmailJob([
                'client' => $client,
                'loanDecisionForm' => $form
            ]));
        }

        if ($form->send_sms) {
            \Yii::$app->queueSms->push(new SendSmsJob([
                'client' => $client,
                'loanDecisionForm' => $form
            ]));
        }
    }
}
