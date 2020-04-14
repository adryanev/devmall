<?php

use yii\db\Migration;

/**
 * Class m200407_082558_alter_pembayaran_transaksi_permintaan_table
 */
class m200407_082558_alter_pembayaran_transaksi_permintaan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%pembayaran_transaksi_permintaan}}','snap_token');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%pembayaran_transaksi_permintaan}}','snap_token',$this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200407_082558_alter_pembayaran_transaksi_permintaan_table cannot be reverted.\n";

        return false;
    }
    */
}
