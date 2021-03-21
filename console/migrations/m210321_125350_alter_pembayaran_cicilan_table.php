<?php

use yii\db\Migration;

/**
 * Class m210321_125350_alter_pembayaran_cicilan_table
 */
class m210321_125350_alter_pembayaran_cicilan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%pembayaran_cicilan}}','code',$this->string());
        $this->addColumn('{{%pembayaran_cicilan}}','payment_url',$this->string());
        $this->addColumn('{{%pembayaran_cicilan}}','payment_token',$this->string());
        $this->addColumn('{{%pembayaran_cicilan}}','payment_status',$this->tinyInteger(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%pembayaran_cicilan}}','code');
        $this->dropColumn('{{%pembayaran_cicilan}}','payment_url');
        $this->dropColumn('{{%pembayaran_cicilan}}','payment_token');
        $this->dropColumn('{{%pembayaran_cicilan}}','payment_status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210321_125350_alter_pembayaran_cicilan_table cannot be reverted.\n";

        return false;
    }
    */
}
