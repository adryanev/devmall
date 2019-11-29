<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%detail_permintaan_produk}}`.
 */
class m191127_120036_create_permintaan_produk_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%permintaan_produk_detail}}', [
            'id' => $this->primaryKey(),
            'id_permintaan'=>$this->integer(),
            'nama_berkas'=>$this->string(),
            'jenis_berkas'=>$this->string(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);

        $this->addForeignKey('fk-detail_pemintaan_produk','{{%permintaan_produk_detail}}','id_permintaan','{{%permintaan_produk}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%permintaan_produk_detail}}');
    }
}
