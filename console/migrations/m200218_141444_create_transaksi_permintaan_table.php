<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaksi_permintaan}}`.
 */
class m200218_141444_create_transaksi_permintaan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transaksi_permintaan}}', [
            'id' => $this->primaryKey(),
            'id_permintaan' => $this->integer(),
            'sudah_dibayar' => $this->bigInteger(),
            'belum_dibayar' => $this->bigInteger(),
            'status' => $this->boolean(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey(
            'fk-transaksi_permintaan-permintaan',
            '{{%transaksi_permintaan}}',
            'id_permintaan',
            '{{%permintaan_produk}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey('fk-transaksi_permintaan-permintaan', '{{%transaksi_permintaan}}');
        $this->dropTable('{{%transaksi_permintaan}}');
    }
}
