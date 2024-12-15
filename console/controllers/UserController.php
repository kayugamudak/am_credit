<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\helpers\Json;
use yii\console\Controller;
use common\forms\UserSignupForm;

class UserController extends Controller
{
    public function actionCreate(string $email, string $password): int
    {
        $form = new UserSignupForm();
        $form->email = $email;
        $form->username = $email;
        $form->password = $password;

        if (!$form->signup()) {
            echo Json::encode($form->getErrorSummary(true), JSON_PRETTY_PRINT) . "\n";
            return 1;
        }

        echo "User successfully added\n";
        return 0;
    }
}
