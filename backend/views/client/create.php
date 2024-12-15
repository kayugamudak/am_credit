<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\USStatesDictionary;

/* @var $this yii\web\View */
/* @var $model common\models\Client */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Create Client';
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'age')->textInput() ?>
    <?= $form->field($model, 'income')->textInput() ?>
    <?= $form->field($model, 'ssn')->textInput(['maxlength' => 9]) ?>
    <?= $form->field($model, 'state_code')->dropDownList(
        USStatesDictionary::getAllStates(),
        ['prompt' => 'Select a state code']
    ) ?>
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'zip')->textInput(['maxlength' => 10]) ?>
    <?= $form->field($model, 'fico_credit_score')->textInput() ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Create Client', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>