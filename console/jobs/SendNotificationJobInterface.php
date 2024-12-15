<?php

namespace console\jobs;

use yii\queue\JobInterface;

interface SendNotificationJobInterface extends JobInterface {
    public function execute($queue): void;
}