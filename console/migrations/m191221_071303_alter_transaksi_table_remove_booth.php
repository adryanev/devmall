<?php

use yii\db\Migration;

/**
 * Class m191221_071303_alter_transaksi_table_remove_booth
 */
class m191221_071303_alter_transaksi_table_remove_booth extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-transaksi_booth', '{{%transaksi_produk}}');
        $this->dropColumn('{{%transaksi_produk}}', 'id_booth');
        $this->dropColumn('{{%transaksi_produk}}', 'metode_pembayaran');
        $this->addColumn('{{%transaksi_produk}}', 'snap_token', $this->string());
        $this->createIndex('idx-transaksi-snap_token', '{{%transaksi_produk}}', 'snap_token');
        $this->createIndex('idx-transaksi-kode_transaksi', '{{%transaksi_produk}}', 'kode_transaksi');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%transaksi_produk}}', 'id_booth', $this->integer());
        $this->addForeignKey('fk-transaksi_booth', '{{%transaksi_produk}}', 'id_booth', '{{%booth}}', 'id');
        $this->addColumn('{{%transaksi_produk}}', 'metode_pembayaran', $this->string());
        $this->dropColumn('{{%transaksi_produk}}', 'snap_token');
        $this->dropIndex('idx-transaksi-snap_token', '{{%transaksi_produk}}');
        $this->dropIndex('idx-transaksi-kode_transaksi', '{{%transaksi_produk}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191221_071303_alter_transaksi_table_remove_booth cannot be reverted.\n";

        return false;
    }
    */
}
