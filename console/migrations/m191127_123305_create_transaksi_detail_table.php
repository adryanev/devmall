<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaksi_detail}}`.
 */
class m191127_123305_create_transaksi_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transaksi_detail}}', [
            'id' => $this->primaryKey(),
            'id_transaksi'=>$this->integer(),
            'id_produk'=>$this->integer(),
            'harga_transaksi'=>$this->bigInteger(),
            'is_promo'=>$this->boolean(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);


        $this->addForeignKey('fk-transaksi_detail-transaksi','{{%transaksi_detail}}','id_transaksi','{{%transaksi}}','id','cascade','cascade');
        $this->addForeignKey('fk-transaksi_detail-produk','{{%transaksi_detail}}','id_produk','{{%produk}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-transaksi_detail-transaksi','{{%transaksi_detail}}');
        $this->dropForeignKey('fk-transaksi_detail-produk','{{%transaksi_detail}}');
        $this->dropTable('{{%transaksi_detail}}');
    }
}
