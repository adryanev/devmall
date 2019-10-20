<?php

use yii\db\Migration;

/**
 * Class m191020_074924_update_galeri_produk_table
 */
class m191020_074924_update_galeri_produk_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('galeri_produk', 'keterangan');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('galeri_produk', 'keterangan', $this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191020_074924_update_galeri_produk_table cannot be reverted.\n";

        return false;
    }
    */
}
