<?php

namespace console\jobs;


class SendSmsJob extends AbstractSendNotificationJob
{

    public function execute($queue): void
    {
        $message = 'Dear ' . $this->client->getFirstName() . ' '. $this->client->getLastName() . PHP_EOL .
            ' Your loan for ' . $this->loanDecisionForm->amount.'$ has been '.
            $this->loanDecisionForm->approved ? 'APPROVED' : 'REJECTED';
        echo $message;
        //send sms here
    }

}
