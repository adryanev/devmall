<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kategori_produk}}`.
 */
class m190828_131659_create_kategori_produk_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%kategori_produk}}', [
            'id_produk' => $this->integer(),
            'id_kategori' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk-kategori_produk-produk', '{{%kategori_produk}}', 'id_produk', '{{%produk}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk-kategori_produk-kategori', '{{%kategori_produk}}', 'id_kategori', '{{%kategori}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kategori_produk}}');
    }
}
