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
        $this->dropForeignKey('fk-transaksi_booth', '{{%transaksi}}');
        $this->dropColumn('{{%transaksi}}', 'id_booth');
        $this->dropColumn('{{%transaksi}}', 'metode_pembayaran');
        $this->addColumn('{{%transaksi}}', 'snap_token', $this->string());
        $this->createIndex('idx-transaksi-snap_token', '{{%transaksi}}', 'snap_token');
        $this->createIndex('idx-transaksi-kode_transaksi', '{{%transaksi}}', 'kode_transaksi');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%transaksi}}', 'id_booth', $this->integer());
        $this->addForeignKey('fk-transaksi_booth', '{{%transaksi}}', 'id_booth', '{{%booth}}', 'id');
        $this->addColumn('{{%transaksi}}', 'metode_pembayaran', $this->string());
        $this->dropColumn('{{%transaksi}}', 'snap_token');
        $this->dropIndex('idx-transaksi-snap_token', '{{%transaksi}}');
        $this->dropIndex('idx-transaksi-kode_transaksi', '{{%transaksi}}');
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
