<?php

use yii\db\Migration;

/**
 * Class m191123_085455_alter_transaksi_table
 */
class m191123_085455_alter_transaksi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%transaksi}}', 'jenis_transaksi', $this->string());
        $this->addColumn('{{%transaksi}}', 'id_booth', $this->integer());
        $this->addForeignKey('fk-transaksi_booth', '{{%transaksi}}', 'id_booth', '{{%booth}}', 'id');

        $this->addColumn('{{%transaksi}}', 'kode_transaksi', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%transaksi}}', 'kode_transaksi');
        $this->dropForeignKey('fk-transaksi_booth', '{{%transaksi}}');
        $this->dropColumn('{{%transaksi}}', 'id_booth');
        $this->dropColumn('{{%transaksi}}', 'jenis_transaksi');


    }

    /*`
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191123_085455_alter_transaksi_table cannot be reverted.\n";

        return false;
    }
    */
}
