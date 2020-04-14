<?php

use yii\db\Migration;

/**
 * Class m200115_120411_add_foreign_key_of_harga_nego_to_keranjang_table
 */
class m200115_120411_add_foreign_key_of_harga_nego_to_keranjang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addForeignKey('fk-keranjang-harga_nego', '{{%keranjang}}', 'id_harga_nego', '{{%harga_nego}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-keranjang-harga_nego', '{{%keranjang}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200115_120411_add_foreign_key_of_harga_nego_to_keranjang_table cannot be reverted.\n";

        return false;
    }
    */
}
