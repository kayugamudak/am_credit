
<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\searchModels\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Client', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'first_name',
            'last_name',
            'age',
            'income',
            'ssn',
            'state_code',
            'city',
            'email:email',
            [
                'label' => 'Loans',
                'format' => 'raw',
                'value' => function ($searchModel) {
                    return Html::a(
                        'loans', // Link text
                        ['client-loan/view-loans', 'clientId' => $searchModel->id], // URL
                        ['class' => 'btn btn-primary', 'target' => '_blank'] // HTML options
                    );
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ],
    ]); ?>
</div>