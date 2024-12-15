<?php

namespace console\jobs;

class SendEmailJob extends AbstractSendNotificationJob
{

    public function execute($queue): void
    {
        $message = 'Dear ' . $this->client->first_name . ' '. $this->client->last_name . PHP_EOL .
        ' Your loan for ' . $this->loanDecisionForm->amount.'$ has been '.
        $this->loanDecisionForm->approved ? 'APPROVED' : 'REJECTED';
        echo $message;
        //send email here
    }

}
