<?php

use yii\db\Migration;

/**
 * Class m210203_065832_alter_pembayaran_table
 */
class m210203_065832_alter_pembayaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('{{%pembayaran}}','{{%payments}}');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable('{{%payments}}','{{%pembayaran}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210203_065832_alter_pembayaran_table cannot be reverted.\n";

        return false;
    }
    */
}
