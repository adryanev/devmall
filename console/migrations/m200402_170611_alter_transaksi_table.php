<?php

use yii\db\Migration;

/**
 * Class m200402_170611_alter_transaksi_table
 */
class m200402_170611_alter_transaksi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%transaksi_produk}}','waktu');
        $this->dropColumn('{{%transaksi_produk}}','total');
        $this->dropColumn('{{%transaksi_produk}}','expire');
        $this->dropColumn('{{%transaksi_produk}}','kode_transaksi');
        $this->dropColumn('{{%transaksi_produk}}','snap_token');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%transaksi_produk}}','waktu',$this->integer());
        $this->addColumn('{{%transaksi_produk}}','total',$this->bigInteger());
        $this->addColumn('{{%transaksi_produk}}','expire',$this->integer());
        $this->addColumn('{{%transaksi_produk}}','kode_transaksi',$this->string());
        $this->addColumn('{{%transaksi_produk}}','snap_token',$this->integer());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200402_170611_alter_transaksi_table cannot be reverted.\n";

        return false;
    }
    */
}
