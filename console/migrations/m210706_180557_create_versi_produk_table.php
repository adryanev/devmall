<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%versi_produk}}`.
 */
class m210706_180557_create_versi_produk_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%versi_produk}}', [
            'id' => $this->primaryKey(),
            'id_produk'=>$this->integer(),
            'link_lama'=>$this->string(),
            'link_baru'=>$this->string(),
            'catatan_perubahan'=>$this->text(),
            'cara_instalasi'=>$this->text(),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);
        $this->addForeignKey('fk-versi-produk','{{%versi_produk}}','id_produk','{{%produk}}','id','cascade','cascade');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%versi_produk}}');
    }
}
