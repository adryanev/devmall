<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cicilan}}`.
 */
class m191127_130002_create_transaksi_cicilan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transaksi_cicilan}}', [
            'id' => $this->primaryKey(),
            'id_transaksi'=>$this->integer(),
            'banyak_cicilan'=>$this->integer(),
            'jumlah_cicilan'=>$this->integer(),
            'tanggal_jatuh_tempo'=>$this->date(),
            'status'=>$this->tinyInteger(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);
        $this->addForeignKey('fk-transaksi_cicilan-transaksi','{{%transaksi_cicilan}}','id_transaksi','{{%transaksi_produk}}','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transaksi_cicilan}}');
    }
}
