<?php

use yii\db\Migration;

/**
 * Class m191223_130150_alter_keranjang_table
 */
class m191223_130150_alter_keranjang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%keranjang}}', 'is_nego', $this->boolean());
        $this->addColumn('{{%keranjang}}', 'id_harga_nego', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191223_130150_alter_keranjang_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191223_130150_alter_keranjang_table cannot be reverted.\n";

        return false;
    }
    */
}
