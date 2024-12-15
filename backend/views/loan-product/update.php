<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model common\models\LoanProduct */

$this->title = 'Update Loan Product: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Loan Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="loan-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'loan_term_days')->textInput() ?>
    <?= $form->field($model, 'percentage_rate')->textInput() ?>
    <?= $form->field($model, 'amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
