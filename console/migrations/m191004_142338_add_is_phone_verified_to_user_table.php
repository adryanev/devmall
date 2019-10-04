<?php

use yii\db\Migration;

/**
 * Class m191004_142338_add_is_phone_verified_to_user_table
 */
class m191004_142338_add_is_phone_verified_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user','is_phone_verified',$this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user','is_phone_verified');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191004_142338_add_is_phone_verified_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
