<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%keluhan}}`.
 */
class m210706_153819_create_keluhan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%keluhan}}', [
            'id' => $this->primaryKey(),
            'id_user'=>$this->integer(),
            'id_produk'=>$this->integer(),
            'judul'=>$this->string(),
            'deskripsi'=>$this->string(),
            'dokumen'=>$this->string(),
            'is_installed'=>$this->boolean(),
            'status'=>$this->tinyInteger(1),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer()
        ]);

        $this->addForeignKey('fk-keluhan-user','{{%keluhan}}','id_user','{{%user}}','id','cascade','cascade');
        $this->addForeignKey('fk-keluhan-produk','{{%keluhan}}','id_produk','{{%produk}}','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%keluhan}}');
    }
}
