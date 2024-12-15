<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model common\models\LoanProduct */

$this->title = 'Create Loan Product';
$this->params['breadcrumbs'][] = ['label' => 'Loan Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'loan_term_days')->textInput() ?>
    <?= $form->field($model, 'percentage_rate')->textInput() ?>
    <?= $form->field($model, 'amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
