<?php

use yii\db\Migration;

/**
 * Class m191004_114920_add_sms_verification_to_user_table
 */
class m191004_114920_add_sms_verification_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','sms_verification',$this->string(6));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','sms_verification');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191004_114920_add_sms_verification_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
