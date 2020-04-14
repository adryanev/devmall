<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%riwayat_permintaan}}`.
 */
class m200126_115959_create_riwayat_permintaan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%riwayat_permintaan}}', [
            'id' => $this->primaryKey(),
            'id_permintaan_produk' => $this->integer(),
            'tanggal' => $this->integer(),
            'keterangan' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey('fk-riwayat_permintaan-permintaan_produk', '{{%riwayat_permintaan}}', 'id_permintaan_produk', '{{%permintaan_produk}}', 'id', 'cascade', 'cascade');
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-riwayat_permintaan-permintaan_produk', '{{%riwayat_permintaan}}');
        $this->dropTable('{{%riwayat_permintaan}}');
    }
}
