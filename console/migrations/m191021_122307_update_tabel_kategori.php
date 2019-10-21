<?php

use yii\db\Migration;

/**
 * Class m191021_122307_update_tabel_kategori
 */
class m191021_122307_update_tabel_kategori extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('kategori', 'frekuensi', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('kategori', 'frekuensi');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191021_122307_update_tabel_kategori cannot be reverted.\n";

        return false;
    }
    */
}
