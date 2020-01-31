<?php

use yii\db\Migration;

/**
 * Class m200126_121432_add_keterangan_to_permintaan_produk_table
 */
class m200126_121432_add_keterangan_to_permintaan_produk_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%permintaan_produk}}', 'keterangan', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%permintaan_produk}}', 'keterangan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200126_121432_add_keterangan_to_permintaan_produk_table cannot be reverted.\n";

        return false;
    }
    */
}
