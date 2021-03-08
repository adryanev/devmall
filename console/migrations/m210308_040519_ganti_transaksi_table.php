<?php

use yii\db\Migration;

/**
 * Class m210308_040519_ganti_transaksi_table
 */
class m210308_040519_ganti_transaksi_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%transaksi_produk}}','promo',$this->integer());
        $this->dropColumn('{{%transaksi_detail}}','is_promo');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%transaksi_produk}}','promo');
        $this->addColumn('{{%transaksi_detail}}','is_promo',$this->tinyInteger());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210308_040519_ganti_transaksi_table cannot be reverted.\n";

        return false;
    }
    */
}
