<?php

namespace yuncms\migrations;

use yii\db\Migration;

/**
 * Class M170825043347Add_coin_field
 */
class M170825043347Add_coin_field extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%user_extend}}', 'coins', $this->integer()->unsigned()->defaultValue(0)->comment('金币'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user_extend}}', 'coins');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M170822043347Add_credit_field cannot be reverted.\n";

        return false;
    }
    */
}
