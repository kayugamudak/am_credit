<?php

use yii\db\Migration;


class m241215_060952_create_client_loan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('client_loan', [
            'id' => $this->primaryKey(),
            'client_id' => $this->bigInteger()->unsigned(),
            'loan_product_id' => $this->bigInteger()->unsigned(),
            'name' => $this->string(1024)->notNull(),
            'loan_term_days' => $this->integer()->notNull(),
            'percentage_rate' => $this->float()->notNull(),
            'amount' => $this->float()->notNull(),
            'approved' => $this->boolean()->defaultValue(false),
            'create_date' => $this->dateTime()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('client_loan');
    }
}
