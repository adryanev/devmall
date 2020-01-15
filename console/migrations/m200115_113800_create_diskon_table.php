<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%diskon}}`.
 */
class m200115_113800_create_diskon_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%diskon}}', [
            'id' => $this->primaryKey(),
            'id_produk' => $this->integer()->unique(),
            'persentase' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->createIndex('idx-diskon-id_produk', '{{%diskon}}', 'id_produk');
        $this->addForeignKey('fk-diskon-produk', '{{%diskon}}', 'id_produk', '{{%produk}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%diskon}}');
    }
}
