<?php

use yii\db\Migration;

/**
 * Class m200225_132411_add_jenis_to_riwayat_transaksi_permintaan
 */
class m200225_132411_add_jenis_to_riwayat_transaksi_permintaan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%riwayat_transaksi_permintaan}}', 'jenis', $this->tinyInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%riwayat_transaksi_permintaan}}', 'jenis');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200225_132411_add_jenis_to_riwayat_transaksi_permintaan cannot be reverted.\n";

        return false;
    }
    */
}
