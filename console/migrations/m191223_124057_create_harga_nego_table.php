<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%harga_nego}}`.
 */
class m191223_124057_create_harga_nego_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%harga_nego}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(),
            'id_produk' => $this->integer(),
            'harga' => $this->bigInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey('fk-harga_nego-user', '{{%harga_nego}}', 'id_user', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-harga_nego-produk', '{{%harga_nego}}', 'id_produk', '{{%produk}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-harga_nego-user', '{{%harga_nego}}');
        $this->dropForeignKey('fk-harga_nego-produk', '{{%harga_nego}}');
        $this->dropTable('{{%harga_nego}}');
    }
}
