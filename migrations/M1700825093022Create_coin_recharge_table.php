<?php

namespace yuncms\coin\migrations;

use yii\db\Migration;

class M1700825093022Create_coin_recharge_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%coin_recharge}}', [
            'id' => $this->primaryKey(),
            'payment_id' => $this->string()->comment('支付号'),
            'user_id' => $this->integer()->comment('用户ID'),
            'name' => $this->integer(),
            'gateway' => $this->string(50)->notNull()->comment('支付网关'),
            'currency' => $this->string(20)->notNull()->comment('支付币种'),
            'money' => $this->decimal(10, 2)->notNull()->defaultValue(0.00)->comment('支付金额'),
            'trade_state' => $this->smallInteger()->notNull()->comment('交易状态'),
            'trade_type' => $this->smallInteger()->notNull()->comment('交易类型'),
            'created_at' => $this->integer()->unsigned()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->unsigned()->notNull()->comment('更新时间'),
        ], $tableOptions);

        $this->addForeignKey('{{%coin_recharge_ibfk_1}}', '{{%coin_recharge}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%coin_recharge}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M170607093022Create_user_coin_recharge_table cannot be reverted.\n";

        return false;
    }
    */
}
