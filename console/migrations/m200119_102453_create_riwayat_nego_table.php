<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%riwayat_nego}}`.
 */
class m200119_102453_create_riwayat_nego_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%riwayat_nego}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(),
            'id_produk' => $this->integer(),
            'waktu_nego' => $this->integer(),
            'harga' => $this->bigInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->createIndex('idx-riwayat_nego-id_user', '{{%riwayat_nego}}', 'id_user');
        $this->createIndex('idx-riwayat_nego-id_waktu_nego', '{{%riwayat_nego}}', 'waktu_nego');
        $this->addForeignKey('fk-riwayat_nego-user', '{{%riwayat_nego}}', 'id_user', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-riwayat_nego-produk', '{{%riwayat_nego}}', 'id_produk', '{{%produk}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-riwayat_nego-produk', '{{%riwayat_nego}}');
        $this->dropForeignKey('fk-riwayat_nego-user', '{{%riwayat_nego}}');
        $this->dropIndex('idx-riwayat_nego-id_waktu_nego', '{{riwayat_nego}}');
        $this->dropIndex('idx-riwayat_nego-id_user', '{{%riwayat_nego}}');
        $this->dropTable('{{%riwayat_nego}}');
    }
}
