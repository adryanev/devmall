<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%keranjang}}`.
 */
class m191119_133928_create_keranjang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%keranjang}}', [
            'id' => $this->primaryKey(),
            'id_user'=>$this->integer(),
            'id_produk'=>$this->integer(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);
        $this->addForeignKey('fk-keranjang-user','{{%keranjang}}','id_user','{{%user}}','id','cascade','cascade');
        $this->addForeignKey('fk-keranjang-produk','{{%keranjang}}','id_produk','{{%produk}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-keranjang-user','{{%keranjang}}');
        $this->dropForeignKey('fk-keranjang-produk','{{%keranjang}}');
        $this->dropTable('{{%keranjang}}');
    }
}
