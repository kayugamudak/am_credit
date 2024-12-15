<?php

use yii\db\Migration;

class m241215_060931_create_client_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('client', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255)->notNull(),
            'age' => $this->integer()->notNull(),
            'ssn' => $this->string(9)->notNull(),
            'state_code' => $this->string(2)->notNull(),
            'city' => $this->string(255)->notNull(),
            'address' => $this->string(255)->notNull(),
            'zip' => $this->string(10)->notNull(),
            'fico_credit_score' => $this->integer()->notNull(),
            'income' => $this->integer()->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string(20)->notNull(),
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('client');
    }
}
