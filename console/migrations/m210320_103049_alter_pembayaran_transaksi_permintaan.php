<?php

use yii\db\Migration;

/**
 * Class m210320_103049_alter_pembayaran_transaksi_permintaan
 */
class m210320_103049_alter_pembayaran_transaksi_permintaan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%pembayaran_transaksi_permintaan}}','code',$this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('{{%pembayaran_transaksi_permintaan}}','code');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210320_103049_alter_pembayaran_transaksi_permintaan cannot be reverted.\n";

        return false;
    }
    */
}
