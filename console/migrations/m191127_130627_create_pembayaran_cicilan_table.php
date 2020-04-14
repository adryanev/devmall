<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaksi_cicilan}}`.
 */
class m191127_130627_create_pembayaran_cicilan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pembayaran_cicilan}}', [
            'id' => $this->primaryKey(),
            'id_transaksi_cicilan'=>$this->integer(),
            'tanggal_pembayaran'=>$this->integer(),
            'jumlah_dibayar'=>$this->integer(),
            'status'=>$this->tinyInteger(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);
        $this->addForeignKey('fk-pembayaran_cicilan-transaksi','{{%pembayaran_cicilan}}','id_transaksi_cicilan','{{%transaksi_cicilan}}','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-pembayaran_cicilan-transaksi','{{%pembayaran_cicilan}}');

        $this->dropTable('{{%pembayaran_cicilan}}');
    }
}
