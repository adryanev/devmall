<?php

use yii\db\Migration;

/**
 * Class m210306_031322_change_keranjang_table
 */
class m210306_031322_change_keranjang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropColumn('{{%keranjang}}', 'is_nego');
        $this->dropColumn('{{%keranjang}}', 'is_diskon');
        $this->dropColumn('{{%keranjang}}', 'id_harga_nego');
        $this->dropForeignKey('fk-keranjang-harga_nego', '{{%keranjang}}');
        $this->dropForeignKey('fk-keranjang-produk', '{{%keranjang}}');
        $this->dropColumn('{{%keranjang}}', 'id_produk');
        $this->addColumn('{{%keranjang}}', 'items', $this->json());
        $this->addColumn('{{%keranjang}}', 'status', $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%keranjang}}', 'is_nego', $this->boolean());
        $this->addColumn('{{%keranjang}}', 'is_diskon', $this->boolean());
        $this->addColumn('{{%keranjang}}', 'id_produk', $this->integer());

        $this->addColumn('{{%keranjang}}', 'id_harga_nego', $this->integer());
        $this->addForeignKey('fk-keranjang-harga_nego', '{{%keranjang}}', 'id_harga_nego', '{{%harga_nego}}', 'id');
        $this->addForeignKey('fk-keranjang-produk', '{{%keranjang}}', 'id_produk', '{{%produk}}', 'id');
        $this->dropColumn('{{%keranjang}}', 'items');
        $this->dropColumn('{{%keranjang}}', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210306_031322_change_keranjang_table cannot be reverted.\n";

        return false;
    }
    */
}
