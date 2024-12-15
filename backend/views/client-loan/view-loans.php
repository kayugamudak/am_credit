<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use common\models\USStatesDictionary;

/* @var $this yii\web\View */
/* @var $client common\models\Client */
/* @var $loanProducts common\models\LoanProduct[] */
/* @var $loanCheckForm backend\models\LoanCheckForm */
/* @var $clientLoans common\models\ClientLoan[] */

$this->title = 'Loans of client: ' . $client->first_name . ' ' . $client->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Client', 'url' => ['client/update/', 'id' => $client->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

//print_r($clientLoans);

echo GridView::widget([
    'dataProvider' => $clientLoans,
    'filterModel' => null, // No filters
    'columns' => [
            'name',
            'loan_term_days',
            'percentage_rate',
            'amount',
            'approved:boolean',
            'create_date',
    ],
    'tableOptions' => ['class' => 'table table-striped table-bordered'], // Custom table styling
]);
//print_r($clientLoans);
?>

<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'loan-check-form',
        'method' => 'post',
        'enableClientValidation' => true
    ]); ?>

    <?= $form->field($loanCheckForm, 'loanProductId')->dropDownList(
        yii\helpers\ArrayHelper::map($loanProducts, 'id', 'name'),
        ['prompt' => 'Select Loan Product']
    ); ?>

    <?= Html::submitButton('Check', ['class' => 'btn btn-primary', 'id' => 'check-loan-btn']) ?>

    <?php ActiveForm::end(); ?>

</div>

<div id="check-result"></div>

<?php
$checkUrl = Url::to(['client-loan/check-loan']);
$decisionUrl = Url::to(['client-loan/loan-decision']);
$csrfInput = Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken);
$this->registerJs(<<<JS


$('#check-loan-btn').on('click', function (e) {
    e.preventDefault();
    
    var loanProductId = $('#loan-check-form').find('[name="LoanCheckForm[loanProductId]"]').val();
    var clientId = '{$client->id}';
    
    $.ajax({
        url: '{$checkUrl}',
        type: 'POST',
        data: {
            loanProductId: loanProductId,
            clientId: clientId
        },
        success: function (response) {
            if (response.success) {
                
                var decisionFormHtml = `
                    <form id='decision-form' action='{$decisionUrl}' method='post'>
                            <input type='hidden' name='LoanDecisionForm[loan_product_id]' class='form-control' value='` + response.loan.loan_product_id + `' />
                            <input type='hidden' name='LoanDecisionForm[percentage_rate]' class='form-control' value='` + response.loan.percentage_rate + `' />
                            <input type='hidden' name='LoanDecisionForm[approved]' value='' id='action-type-field' />
                            <input type='hidden' name='LoanDecisionForm[loan_term_days]' value='` + response.loan.loan_term_days + `' id='action-type-field' />
                            <input type='hidden' name='LoanDecisionForm[amount]' value='` + response.loan.amount + `' id='action-type-field' />
                            <input type='hidden' name='LoanDecisionForm[client_id]' value='` + clientId + `' id='action-type-field' />
                            <input type='hidden' name='LoanDecisionForm[name]' value='` + response.loan.name + `' id='action-type-field' />
                            {$csrfInput}
                `;
                if (response.loan.pre_approved) {
                    decisionFormHtml = decisionFormHtml + `<h3>` + response.loan.name + ` Pre-Approved</h3>`;

                } else {
                    decisionFormHtml = decisionFormHtml + `<h3>` + response.loan.name + ` Denied</h3>`;
                }
                
                decisionFormHtml = decisionFormHtml + 
                `<div class="form-group">
                    <label for="send_email">
                        <input type='checkbox' id='send_email' name='LoanDecisionForm[send_email]' value='1'> Send email  
                    </label>
                </div>
                <div class="form-group">
                    <label for="send_sms">
                        <input type='checkbox' id='send_sms' name='LoanDecisionForm[send_sms]' value='1'> Send sms
                    </label>
                </div>`;

                if (response.loan.pre_approved) {
                    decisionFormHtml = decisionFormHtml + `<button type='button' class='btn btn-success' id='accept-button'>Submit</button>`;
                }
                decisionFormHtml = decisionFormHtml + `<button type='button' class='btn btn-danger' id='reject-button'>Reject</button>                        
                    </form>`;
                

                $('#check-result').html(decisionFormHtml);
                
               $('#accept-button').on('click', function() {
                    $('#action-type-field').val(1);
                    $('#decision-form').submit();
                });
               
                $('#reject-button').on('click', function() {
                    $('#action-type-field').val(0);
                    $('#decision-form').submit();
                });

            } else {
                $('#check-result').html('');
            }
        },
        error: function(response) {
            $('#check-result').html('');
        }

    });
});


JS
);
?>
