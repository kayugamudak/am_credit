<?php

use yii\db\Migration;

class m241215_060941_create_loan_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('loan_product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(1024)->notNull(),
            'loan_term_days' => $this->integer()->notNull(),
            'percentage_rate' => $this->float()->notNull(),
            'amount' => $this->float()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('loan_product');
    }
}
