<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%riwayat_transaksi_permintaan}}`.
 */
class m200218_141903_create_riwayat_transaksi_permintaan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%riwayat_transaksi_permintaan}}', [
            'id' => $this->primaryKey(),
            'id_transaksi_permintaan' => $this->integer(),
            'nominal' => $this->bigInteger(),
            'status' => $this->tinyInteger(),
            'snap_token' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey(
            'fk-riwayat_tp-tp',
            '{{%riwayat_transaksi_permintaan}}',
            'id_transaksi_permintaan',
            '{{%transaksi_permintaan}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey('fk-riwayat_tp-tp', '{{%riwayat_transaksi_permintaan}}');
        $this->dropTable('{{%riwayat_transaksi_permintaan}}');
    }
}
