<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $searchModel common\searchModels\LoanProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Loan Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Loan Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'loan_term_days',
            'percentage_rate',
            'amount',
            [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}',
            ],
        ],
    ]); ?>
</div>
