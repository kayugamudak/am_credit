<?php

namespace console\jobs;

use backend\models\LoanDecisionForm;
use yii\base\BaseObject;
use common\models\ClientInterface;

abstract class AbstractSendNotificationJob extends BaseObject implements SendNotificationJobInterface
{

    public ClientInterface $client;
    public LoanDecisionForm $loanDecisionForm;

    abstract public function execute($queue): void;
}
