<?php

use yii\db\Migration;

/**
 * Class m210309_095206_alter_pembayaran_transaksi_permintaan_table
 */
class m210309_095206_alter_pembayaran_transaksi_permintaan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%pembayaran_transaksi_permintaan}}','payment_token',$this->string());
        $this->addColumn('{{%pembayaran_transaksi_permintaan}}','payment_status',$this->tinyInteger(1));
        $this->addColumn('{{%pembayaran_transaksi_permintaan}}','payment_url',$this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%pembayaran_transaksi_permintaan}}','payment_token');
        $this->dropColumn('{{%pembayaran_transaksi_permintaan}}','payment_status');
        $this->dropColumn('{{%pembayaran_transaksi_permintaan}}','payment_url');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210309_095206_alter_pembayaran_transaksi_permintaan_table cannot be reverted.\n";

        return false;
    }
    */
}
